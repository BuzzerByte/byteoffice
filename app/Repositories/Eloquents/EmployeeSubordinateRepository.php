<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeSubordinateRepository;
use App\EmployeeSubordinate;

class EmployeeSubordinateRepository implements IEmployeeSubordinateRepository{
    protected $employeeSubordinates;

    public function __construct(
        EmployeeSubordinate $employeeSubordinates
    ){
        $this->employeeSubordinates = $employeeSubordinates;
    }

    public function checkSubordinatesExists($id){
        return $this->employeeSubordinates->where('employee_id',$id)->first() == null ? false: true;
    }

    public function getSubordinateById($id){
        return $this->employeeSubordinates->where('employee_id',$id)->get();
    }
}