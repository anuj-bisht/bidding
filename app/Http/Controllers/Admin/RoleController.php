<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index(){
        $roles['data']=Role::all();
        return view('admin/role/index', $roles);
    }
    public function create(){

        return view('admin/role/create');
    }
    public function store(Request $request){
        $validated=$request->validate([
            'name'=>'required|min:3'
        ]);
       Role::Create($validated);
       $request->session()->flash('message', 'New Role Added');
        return redirect('roles');
    }
    public function edit(Role $id){
        $data['permissions']=Permission::all();
        $data['role']=$id;
        return view('admin/role/edit', $data);

    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required|min:3'
        ]);
        $role=Role::find($id);
        $role->name=$request->name;
        $role->save();
        $request->session()->flash('message', 'Role Update Successfully');
        return redirect('roles');
}

    public function givePermission(Request $request, Role $role)
    {
      if($role->hasPermissionTo($request->permission)){
         return redirect()->back()->with('message', 'Permission already exist');
      }else{
        $role->givePermissionTo($request->permission);
        return redirect()->back()->with('message', 'Permission assigned Succesfully');

      }
    }

    public function revokePermission( Role $role , Permission $permission)
    {

      if($role->hasPermissionTo($permission)){
        $role->revokePermissionTo($permission);
         return redirect()->back()->with('message', 'Remove permission');
      }
        return redirect()->back()->with('message', 'Permission not exist');


    }
}
