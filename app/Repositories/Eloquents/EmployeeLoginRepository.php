<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeLoginRepository;
use App\EmployeeLogin;

class EmployeeLoginRepository implements IEmployeeLoginRepository{
    protected $employeeLogins;

    public function __construct(
        EmployeeLogin $employeeLogins
    ){
        $this->employeeLogins = $employeeLogins;
    }

    public function checkLoginExists($id){
        return $this->employeeLogins->where('employee_id',$id)->first() == null ? false: true;
    }
}