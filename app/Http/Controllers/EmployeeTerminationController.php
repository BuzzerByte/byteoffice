<?php

namespace App\Http\Controllers;

use App\EmployeeTermination;
use App\Employee;
use App\User;
use Illuminate\Http\Request;
use App\Services\EmployeeTerminationService;

class EmployeeTerminationController extends Controller
{
    protected $employeeTerminations;

    public function __construct(IEmployeeTerminationRepository $employeeTerminations){
        $this->employeeTerminations = $employeeTerminations;
    }
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
        $result = $this->employeeTerminations->store($request);
        return redirect()->route('employees.show',$request->employee_id);
    }

    public function unterminate(EmployeeTermination $employeeTermination){
        Employee::where('id',$employeeTermination->employee_id)->update([
            'terminate_status'=>0
        ]);
        // $result = $this->employeeTerminations->unterminate()
        return redirect()->route('employees.show',$employeeTermination->employee_id);
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
        return redirect()->route('employeeTerminations.show',$employeeTermination->id);
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
