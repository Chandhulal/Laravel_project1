<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function __construct() {
        $this->middleware('permission:view role',['only'=> ['index']]);
        $this->middleware('permission:add role',['only'=> ['create','store','give_permission','add_permission']]);
        $this->middleware('permission:edit role',['only'=> ['edit','update']]);
        $this->middleware('permission:delete role',['only'=> ['destroy']]);
        $this->middleware('permission:edit user_role and user_permission',['only'=> ['give_permission','add_permission']]);
    }

    public function index()
    {
        //
        $data = Role::all();
        return view('actions.roles.indux', ["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('actions.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //
        Role::create([
            'name' => request()->role,
        ]);
        return redirect('roles')->with('status', 'created succesfully');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = Role::find($id);
        return view('actions.roles.edit', ["data" => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        //
        $data = Role::find($id);
        $data->update([
            'name' => request()->role,
        ]);
        return redirect('/roles')->with('status', 'edited succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Role::find($id);
        $data->delete();
        return redirect('/roles')->with('error', 'Deleted succesfully');
    }

    public function give_permission($id) 
    {
        $data = Role::find($id);
        $permission = Permission::all();
        $permission_id = DB::table('role_has_permissions')->where('role_id','=',$id)->pluck('permission_id')->toArray();
       
        return view('actions.roles.give_permission', [
            "data" => $data,
            "permission" => $permission,
            "permission_id" => $permission_id,
        ]);
    }

    public function add_permission($id) 
    {
        $role = Role::find($id);
        $role->syncPermissions(request()->permission);
        return redirect('/roles')->with('status', 'Added succesfully');
    }
}
