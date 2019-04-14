<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\EmployeeAward;
use buzzeroffice\Employee;
use buzzeroffice\Department;
use buzzeroffice\User;
use Auth;
use Illuminate\Http\Request;

class EmployeeAwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')){
            $awards = EmployeeAward::all();
            $employees = User::all();
            $departments = Department::all();
            return view('admin.employeeAwards.index',['awards'=>$awards,'employees'=>$employees,'departments'=>$departments]);
        }else{
            $awards = EmployeeAward::all();
            $employees = User::all();
            $departments = Department::all();
            return view('users.awards.index',['awards'=>$awards,'employees'=>$employees,'departments'=>$departments]);
        }
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
        $request->month = \Carbon\Carbon::parse($request->month)->format('Y-m-d');
        $store = EmployeeAward::create([
            'department_id'=>(int)$request->department_id,
            'employee_id'=>(int)$request->employee_id,
            'award'=>$request->award_name,
            'gift'=>$request->gift_item,
            'amount'=>$request->award_amount,
            'month'=>$request->month
        ]);
        return redirect()->action('EmployeeAwardController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\EmployeeAward  $employeeAward
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeAward $employeeAward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\EmployeeAward  $employeeAward
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeAward $employeeAward)
    {
        return response()->json($employeeAward);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\EmployeeAward  $employeeAward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeAward $employeeAward)
    {
        $request->month = \Carbon\Carbon::parse($request->month)->format('Y-m-d');
        $update = EmployeeAward::where('id',$employeeAward->id)->update([
            'department_id'=>$request->department_id,
            'employee_id'=>$request->employee_id,
            'award'=>$request->award_name,
            'gift'=>$request->gift_item,
            'amount'=>$request->award_amount,
            'month'=>$request->month,
        ]);
        return redirect()->action('EmployeeAwardController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\EmployeeAward  $employeeAward
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeAward $employeeAward)
    {
        return response()->json($employeeAward);
    }

    public function delete(EmployeeAward $employeeAward)
    {
        $delete = EmployeeAward::find($employeeAward->id);
        $delete->delete();
        
        return redirect()->action(
            'EmployeeAwardController@index'
        );
    }
}
