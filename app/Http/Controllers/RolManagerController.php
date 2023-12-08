<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolManagerController extends Controller
{
    function rolemanager(){
        $permission=Permission::all();
        $roles=Role::all();

        return view('role.role',[
            'permissions'=>$permission,
            'roles'=>$roles
        ]);
    }
    function role_store(Request $request){
        Permission::create(['name' =>$request->permission_name]);
        return back();

    }
    function permission_store(Request $request){
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permission_id);
    }
}
