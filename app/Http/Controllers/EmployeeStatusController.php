<?php

namespace App\Http\Controllers;

use App\EmployeeStatus;
use Illuminate\Http\Request;

class EmployeeStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = EmployeeStatus::all();
        return view('admin.employeestatus.index',['status'=>$status]);
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
        $store = EmployeeStatus::create([
            'status' => $request->status
        ]);
        return redirect()->route('employeestatus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeStatus  $employeeStatus
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeStatus $employeeStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeStatus  $employeeStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeStatus $employeestatus)
    {
        //
        return response()->json($employeestatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeStatus  $employeeStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeStatus $employeestatus)
    {
        //
        $update = EmployeeStatus::where('id',$employeestatus->id)->update([
            'status'=>$request->status
        ]);
        return redirect()->route('employeestatus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeStatus  $employeeStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeStatus $employeeStatus)
    {
        //
    }

    public function delete(EmployeeStatus $employeestatus){
        $delete = EmployeeStatus::find($employeestatus->id);
        $delete->delete();
        return redirect()->route('employeestatus.index');
    }
}
