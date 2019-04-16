<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\EmployeeSupervisor;
use Illuminate\Http\Request;

class EmployeeSupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $store = EmployeeSupervisor::create([
            'department_id'=>$request->department_id,
            'supervisor_id'=>$request->supervisor_id,
            'employee_id'=>$request->employee_id
        ]);
        return redirect()->action('UserController@reportTo',['id'=>$request->employee_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\EmployeeSupervisor  $employeeSupervisor
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeSupervisor $employeeSupervisor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\EmployeeSupervisor  $employeeSupervisor
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeSupervisor $employeeSupervisor)
    {
        return response()->json($employeeSupervisor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\EmployeeSupervisor  $employeeSupervisor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeSupervisor $employeeSupervisor)
    {
        $update = EmployeeSupervisor::where('id',$employeeSupervisor->id)->update([
            'department_id'=>$request->department_id,
            'supervisor_id'=>$request->supervisor_id,
        ]);
        return redirect()->action('UserController@reportTo',['id'=>$employeeSupervisor->employee_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\EmployeeSupervisor  $employeeSupervisor
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeSupervisor $employeeSupervisor)
    {
        //
    }

    public function delete(Request $request){
        $supervisorId_arr = $request->supervisorId;
        if($supervisorId_arr!=null){
            foreach($supervisorId_arr as $id){
                $supervisor = EmployeeSupervisor::find((int)$id);
                $supervisor->delete();
            }
            return redirect()->action('UserController@reportTo',['id'=>$request->employee_id]);
        }else{
            return redirect()->action('UserController@reportTo',['id'=>$request->employee_id]);
        }
    }
}
