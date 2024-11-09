<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use App\Services\MediaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Intervention\Image\ImageManagerStatic as Image;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->first();
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'Successfully logged in');
        } else {
            return redirect('/login')->with('error', 'UserName or Password did not match');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('auth.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('auth.users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validation
            $validator = Validator::make($request->all(),[
                'name' => 'required|max:100',
                'email' => 'nullable|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ]);
    
            if($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $user->assignRole($request->role);

            return redirect()->route('users.index')->with('success', $request->role . ' has been created');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('auth.users.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            // Validation
            $validator = Validator::make($request->all(),[
                'name' => 'required|max:100',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:6|confirmed'
            ]);
    
            if($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            if($user->agent_id != '') {
                $agent = Agent::where('id', $user->agent_id)->first();
                $agent->agency_name = $user->name;
                $agent->email = $user->email;
                $agent->save();
            }

            if ($request->role) {
                $user->removeRole($request->old_role);
                $user->assignRole($request->role);
            }

            return redirect()->route('users.index')->with('success', $request->old_role . ' has been updated');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
        $user = User::find($id);

        if (!is_null($user)) {
            $user->delete();
        }

        return redirect()->route('users.index')->with('success', 'User has been deleted');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Display specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        return view('auth.users.profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);
        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'password' => 'nullable|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        $user->name = $request->name;
        $user->email = $user->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            if (file_exists(public_path('storage/users/' . $user->image)) && (($user->image) != '')) {
                unlink(public_path('storage/users/' . $user->image));
            }

            $image_name = time() . '.' . $request->image->getClientOriginalExtension();
            $dir = 'storage/users/'; //use directory like this,you can use other name instead storage. but please use this pattern. this is user image not backend image. it can be used anywhere.
            if (!is_dir($dir)) {
                File::makeDirectory(public_path($dir), 0755, true, true);
            }

            $path = Image::make($request->file('image')->getPathName())->resize(150, 150)->save(public_path($dir . $image_name));
            $user->image = $image_name;
        }

        if ($user->save()) {
            if($user->agent_id != '') {
                $agent = Agent::where('id', $user->agent_id)->first();
                $agent->agency_name = $user->name;

                $agent->save();
            }

            return redirect()->back()->with('success', 'Your profile has been updated');
        } else {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }
}
