<?php

namespace App\Repositories\Eloquents;

use App\Employee;
use Auth;
use App\Repositories\Interfaces\IEmployeeRepository;
use Illuminate\Http\Request;

class EmployeeRepository implements IEmployeeRepository{
    protected $employees;

    public function __construct(Employee $employees){
        $this->employees = $employees;
    }

    public function all(){
        return $this->employees->where('user_id',Auth::user()->id)
                                ->where('terminate_status',0)
                                ->orderBy('created_at','asc')
                                ->get();
    }

    public function store(Request $request, $file_name){
        $employee = $this->employees;
        $employee->f_name = $request->first_name;
        $employee->l_name = $request->last_name;
        $employee->dob = $request->date_of_birth;
        $employee->marital_status = $request->marital_status;
        $employee->country = $request->country;
        $employee->blood_group = $request->blood_group;
        $employee->id_number = $request->id_number;
        $employee->religious = $request->religious;
        $employee->gender = $request->gender;
        $employee->photo = $file_name;
        $employee->terminate_status = 0;
        return $employee->save();
    }
}