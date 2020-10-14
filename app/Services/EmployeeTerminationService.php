<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IEmployeeTerminationRepository;
use App\Repositories\Interfaces\IEmployeeRepository;

class EmployeeTerminationService{
    protected $employeeTerminations;
    protected $employees;

    public function __construct(
        IEmployeeTerminationRepository $employeeTerminations,
        IEmployeeRepository $employees
    ){
        $this->employeeTerminations = $employeeTerminations;
        $this->employees = $employees;
    }

    public function store(Request $request){
        $result = $this->employeeTermination->updateOrCreate($request);
        $employees = $this->employees->updateTerminationStatus($id);
        return [
            'result' => $result['result']
        ];
    }
}