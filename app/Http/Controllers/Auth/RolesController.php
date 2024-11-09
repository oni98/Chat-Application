<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('auth.roles.index', ['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('auth.roles.create', ['permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|max:100|unique:roles'
        ], [
            'name.required' => 'Name can not be empty',
            'name.unique' => 'Name already exists'
        ]);
        $role = Role::create(['name' => $request->name]);

        $permissions = $request->input('permissions');
        if(!empty($request->permissions)){
            $role->syncPermissions($permissions);
        }
        return redirect()->route('roles.index');
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
        $role = Role::findById($id);
        $permissions = Permission::all();
        return view('auth.roles.edit', ['permissions'=>$permissions, 'role' => $role]);
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
        // Validation
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,'.$id
        ], [
            'name.required' => 'Name can not be empty',
        ]);
        $role = Role::findById($id);

        $permissions = $request->input('permissions');
        if(!empty($request->permissions)){
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }


        return redirect()->route('roles.index')->with('success', 'Role has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findById($id);

        if(!is_null($role)){
            $role->delete();
        }

        session()->flash('success', 'Role has been Deleted');
        return redirect()->route('roles.index');
    }
}
