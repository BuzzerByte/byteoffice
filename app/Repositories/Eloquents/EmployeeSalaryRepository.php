<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeSalaryRepository;
use App\EmployeeSalary;

class EmployeeSalaryRepository implements IEmployeeSalaryRepository{
    protected $employeeSalaries;

    public function __construct(EmployeeSalary $employeeSalaries){
        $this->employeeSalaries = $employeeSalaries;
    }

    public function checkSalaryExists($id){
        return $this->employeeSalaries->where('employee_id',$id)->first() == null ? false: true;
    }

    public function getSalaryById($id){
        return [
            'salary' => $this->employeeSalaries->where('employee_id',$id)->get()
        ];
    }

    public function storeSalaryById($id){
        $salary = $this->employeeSalaries;
        $salary->employee_id = $id;
        return [
            'result' => $salary->save(),
            'salary' => $salary
        ];
    }
}