<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.departments.index',['departments'=>$departments]);
    }

    public function store(Request $request)
    {
        $store = Department::create([
            'name'=>$request->department,
            'description'=>$request->description
        ]);
        return redirect()->action('DepartmentController@index');
    }

    public function edit(Department $department)
    {
        return response()->json($department);
    }

    public function update(Request $request, Department $department)
    {
        $update = Department::where('id',$department->id)->update([
            'name'=>$request->department,
            'description'=>$request->description
        ]);
        return redirect()->action('DepartmentController@index');
    }

    public function delete(Department $department){
        
        $delete = Department::find($department->id);
        $delete->delete();
        
        return redirect()->action('DepartmentController@index');
    }
}
