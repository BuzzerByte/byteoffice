<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\EmployeeCommencement;
use Illuminate\Http\Request;

class EmployeeCommencementController extends Controller
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
        $store = EmployeeCommencement::updateOrCreate(
            ['employee_id'=>$request->employee_id],
            ['join_date'=>$request->joined_date,
            'probation_end'=>$request->probation_end_date,
            'dop'=>$request->date_of_permanency]
        );
        if($store){

        }else{

        }
        return redirect()->action('UserController@employeeCommencements',['id'=>$request->employee_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\EmployeeCommencement  $employeeCommencement
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeCommencement $employeeCommencement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\EmployeeCommencement  $employeeCommencement
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeCommencement $employeeCommencement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\EmployeeCommencement  $employeeCommencement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeCommencement $employeeCommencement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\EmployeeCommencement  $employeeCommencement
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeCommencement $employeeCommencement)
    {
        //
    }
}
