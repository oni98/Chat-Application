<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $data['roles'] = Role::all();
        return view('auth.roles.index', $data);
    }

    public function create(){
        return view('auth.roles.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:100|unique:roles'
        ], [
            'name.required' => 'Name can not be empty',
            'name.unique' => 'Name already exists'
        ]);
        $role = Role::create(['name' => $request->name]);
        return redirect()->route('role.index');
    }

    public function edit($id){
        $data['role'] = Role::findById($id);
        return view('auth.roles.edit',$data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,'
        ]);
        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();
        return redirect()->route('role.index');
    }

    public function destroy($id){
        $role = Role::findById($id);
        $role->delete();
        return redirect()->route('role.index');
    }

}
