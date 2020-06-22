<?php

namespace App\Http\Controllers;

use App\EmployeeTermination;
use App\Employee;
use App\User;
use Illuminate\Http\Request;

class EmployeeTerminationController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = EmployeeTermination::updateOrCreate(
            [
                'employee_id'=>(int)$request->employee_id
            ],[
                'date'=>$request->termination_date,
                'reason'=>$request->termination_reason,
                'note'=>$request->termination_note
            ]
        );
        User::where('id',$request->employee_id)->update([
            'terminate_status'=>1
        ]);
        return redirect()->action('UserController@show',['id'=>$request->employee_id]);
    }

    public function unterminate(EmployeeTermination $employeeTermination){
        User::where('id',$employeeTermination->employee_id)->update([
            'terminate_status'=>0
        ]);
        return redirect()->action('UserController@show',['id'=>$employeeTermination->employee_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeTermination  $employeeTermination
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeTermination $employeeTermination)
    {
        $employee = User::where('id',$employeeTermination->employee_id)->first();
        return view('admin.employeeTerminations.show',['employee'=>$employee, 'terminated'=>$employeeTermination]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeTermination  $employeeTermination
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeTermination $employeeTermination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeTermination  $employeeTermination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeTermination $employeeTermination)
    {
        $update = EmployeeTermination::where('id',$employeeTermination->id)->update([
            'date'=>$request->termination_date,
            'reason'=>$request->termination_reason,
            'note'=>$request->termination_note
        ]);
        return redirect()->action('EmployeeTerminationController@show',['id'=>$employeeTermination->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeTermination  $employeeTermination
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeTermination $employeeTermination)
    {
        //
    }
}
