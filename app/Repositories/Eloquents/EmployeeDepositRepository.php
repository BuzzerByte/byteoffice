<?php

namespace App\Repositories\Eloquents;

use App\EmployeeDeposit;
use App\Repositories\Interfaces\IEmployeeDepositRepository;

class EmployeeDepositRepository implements IEmployeeDepositRepository{
    protected $employeeDeposits;

    public function __construct(
        EmployeeDeposit $employeeDeposits
    ){
        $this->employeeDeposits = $employeeDeposits;
    }

    public function checkDepositExists($id){
        return $this->employeeDeposits->where('employee_id',$id)->first() == null ? false: true;
    }

    public function getDepositById($id){
        return $this->employeeDeposits->where('employee_id',$id)->first();
    }

    public function storeDepositById($id){
        $deposit = $this->employeeDeposits;
        $deposit->employee_id = $id;
        return [
            'result' => $deposit->save(),
            'deposit' => $deposit
        ];
    }
}