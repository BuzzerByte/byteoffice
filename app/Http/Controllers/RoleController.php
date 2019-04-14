<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\Role;
use buzzeroffice\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.roles.index',['roles'=>$roles,'permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return response()->json($request->permission[1]);
        $role = new Role();
        $role->name         =  $request->name;
        $role->display_name = $request->display_name; // optional
        $role->description  = $request->description; // optional
        $role->save();

        $role->attachPermissions($request->permission);

        return redirect()->action('RoleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        $permissions = $role->permissions()->select('id')->get();
        return response()->json(['role'=>$role,'permission'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        $update = Role::where('id',$role->id)->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->description
        ]);
        $role = Role::find($role->id);
        if($request->permission != null){
            $role->perms()->sync([]);
            $role->attachPermissions($request->permission);
        }else{
            $role->perms()->sync([]);
        }
        return redirect()->action('RoleController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        //return response()->json($role);
        $delete = Role::findOrFail($role->id);
        $delete->delete();
        
        return redirect()->action('RoleController@index');
    }
}
