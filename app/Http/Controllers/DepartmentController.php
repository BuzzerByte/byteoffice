<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index',['departments'=>$departments]);
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
        $store = Department::create([
            'name'=>$request->department,
            'description'=>$request->description
        ]);
        return redirect()->action('DepartmentController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return response()->json($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $update = Department::where('id',$department->id)->update([
            'name'=>$request->department,
            'description'=>$request->description
        ]);
        return redirect()->action('DepartmentController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }

    public function delete(Department $department){
        
        $delete = Department::find($department->id);
        $delete->delete();
        
        return redirect()->action('DepartmentController@index');
    }
}
