<?php

namespace App\Http\Controllers;

use App\EmployeeCommencement;
use Illuminate\Http\Request;

class EmployeeCommencementController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }

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
        return redirect()->route('users.employeeCommencements',$request->employee_id);
    }

    public function show(EmployeeCommencement $employeeCommencement)
    {
        //
    }

    public function edit(EmployeeCommencement $employeeCommencement)
    {
        //
    }

    public function update(Request $request, EmployeeCommencement $employeeCommencement)
    {
        //
    }

    public function destroy(EmployeeCommencement $employeeCommencement)
    {
        //
    }
}
