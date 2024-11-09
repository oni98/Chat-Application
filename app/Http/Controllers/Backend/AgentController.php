<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    private $root = 'backend.agents.';

    public function register()
    {
        return view($this->root . 'register');
    }

    public function index()
    {
        $agents = Agent::where('status', 1)->get();
        return view($this->root . 'index', ['users' => $agents]);
    }

    public function store(Request $request)
    {
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $user = new Agent();
            do {
                $code = random_int(100000, 999999);
            } while (Agent::where("code", "=", $code)->first());
            $code = 'AG-' . $code;

            $user = $this->patch($user, $request, $code);
            if($user->save()) {
                $admin = User::role('Super Admin')->first();

                return redirect()->back()->with('success', 'Registration form submitted successfully');
            }

            return redirect()->back()->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function pendingAgent()
    {
        $agents = Agent::where('status', '0')->get();
        return view($this->root . 'pending_agents', with(['agents' => $agents]));
    }

    public function approveAgent($id)
    {
        DB::beginTransaction();
        try {
            $agent = Agent::find($id);
            $agent->status = 1;
            if ($agent->save()) {
                $user = new User();
                $user->name = $agent->agency_name;
                $user->email = $agent->email;
                $user->password = $agent->password;
                $user->agent_id = $agent->id;
                $user->assignRole('Agent');
                $user->save();

                DB::commit();
                return redirect()->back()->with('success', 'New agent has been approved');
            }

            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function show($id)
    {
        $agent = Agent::find($id);
        return view($this->root . 'view', ['agent' => $agent]);
    }

    public function edit($id)
    {
        $agent = Agent::find($id);

        Session::flash('url',request()->headers->get('referer')); // Store previous url
        return view($this->root . 'edit', ['agent' => $agent]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $agent = Agent::find($id);
            // Validation
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:agents,email,' . $id,
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $agent = $this->patch($agent, $request, $agent->code);

            if ($agent->save()) {
                $user = User::where('agent_id', $id)->first();
                $user->name = $agent->agency_name;
                $user->email = $agent->email;
                $user->save();

                DB::commit();
                return Redirect::to(Session::get('url'))->with('success', 'Agent updated successfully'); // Redirect to session stored url
            }
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $agent = Agent::find($id);

            if($agent->status == 0){
                if ($agent->delete()) {
                    Storage::deleteDirectory('public/agents/' . $agent->code);
            
                    DB::commit();
                    return redirect()->back()->with('success', 'Agent has been deleted');
                }
            } else {
                $user = User::where('agent_id', $id)->first();
                if (!empty($user)) {
                    if($user->delete()){
                        if ($agent->delete()) {
                            Storage::deleteDirectory('public/agents/' . $agent->code);
            
                            DB::commit();
                            return redirect()->back()->with('success', 'Agent has been deleted');
                        }
                    }
                }
            }
            
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'First remove Agent\'s referred applications to delete');
        }
    }

    /**
     * @param $user
     * @param $request
     * @param $code
     * @return object
     */
    private function patch($user, $request, $code): object
    {
        $user->code = $code;
        $user->agency_name = $request->agency_name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        return $user;
    }
}
