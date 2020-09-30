<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeSupervisorRepository;
use App\EmployeeSupervisor;


class EmployeeSupervisorRepository implements IEmployeeSupervisorRepository{
    protected $employeeSupervisors;

    public function __construct(
        EmployeeSupervisor $employeeSupervisors
    ){
        $this->employeeSupervisors = $employeeSupervisors;
    }

    public function checkSupervisorsExistsById($id){
        return $this->employeeSupervisors->where('employee_id',$id)->first() == null ? false:true;
    }

    public function getSupervisoryById($id){
        return $this->employeeSupervisors->where('employee_id',$employee->id)->get();
    }
}