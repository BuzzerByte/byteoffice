<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeDependentRepository;
use App\EmployeeDependent;

class EmployeeDependentRepository implements IEmployeeDependentRepository{
    protected $employeeDependents;

    public function __construct(EmployeeDependent $employeeDependents){
        $this->employeeDependents = $employeeDependents;
    }

    public function checkDependentExists($id){
        return $this->employeeDependents->where('employee_id',$id)->first() == null ? false: true;
    }

    public function getDependentById($id){
        return $this->employeeDependents->where('employee_id',$id)->get();
    }
}