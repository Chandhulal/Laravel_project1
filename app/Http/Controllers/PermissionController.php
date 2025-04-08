<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function __construct() {
        $this->middleware('permission:view permission',['only'=> ['index']]);
        $this->middleware('permission:add permission',['only'=> ['create','store']]);
        $this->middleware('permission:edit permission',['only'=> ['edit','update']]);
        $this->middleware('permission:delete permission',['only'=> ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Permission::all();
        return view('actions.permissions.indux', ["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('actions.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //
        Permission::create([
            'name' => request()->permission,
        ]);
        return redirect('permissions')->with('status', 'created succesfully');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = Permission::find($id);
        return view('actions.permissions.edit', ["data" => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        //
        $data = Permission::find($id);
        $data->update([
            'name' => request()->permission,
        ]);
        return redirect('/permissions')->with('status', 'edited succesfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Permission::find($id);
        $data->delete();
        return redirect('/permissions')->with('error', 'Deleted succesfully');
    }
}
