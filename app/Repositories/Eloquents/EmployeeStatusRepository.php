<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeStatusRepository;
use App\EmployeeStatus;
use Auth;

class EmployeeStatusRepository implements IEmployeeStatusRepository{
    protected $employeeStatuses;

    public function __construct(EmployeeStatus $employeeStatuses){
        $this->employeeStatuses = $employeeStatuses;
    }

    public function all(){
        return $this->employeeStatuses->where('user_id',Auth::user()->id)
                    ->orderBy('created_at','asc')
                    ->get();
    }
}