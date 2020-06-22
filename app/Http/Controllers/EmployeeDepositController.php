<?php

namespace App\Http\Controllers;

use App\EmployeeDeposit;
use Illuminate\Http\Request;

class EmployeeDepositController extends Controller
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
        $update = EmployeeDeposit::where('employee_id',$request->employee_id)->updateOrCreate(
            ['employee_id'=>$request->employee_id],
            [
                'account_name'=>$request->account_name,
                'number'=>$request->account_number,
                'bank_name'=>$request->bank_name,
                'note'=>$request->note
            ]
        );
        return redirect()->action('UserController@directDeposit',['id'=>$request->employee_id]);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployeeDeposit  $employeeDeposit
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeDeposit $employeeDeposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployeeDeposit  $employeeDeposit
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeDeposit $employeeDeposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployeeDeposit  $employeeDeposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeDeposit $employeeDeposit)
    {
        $update = EmployeeDeposit::where('id',$employeeDeposit->id)->update([
            'account_name'=>$request->account_name,
            'number'=>$request->account_number,
            'bank_name'=>$request->bank_name,
            'note'=>$request->note
        ]);
        
        return redirect()->action('UserController@directDeposit',['id'=>$employeeDeposit->employee_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployeeDeposit  $employeeDeposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeDeposit $employeeDeposit)
    {
        //
    }
}
