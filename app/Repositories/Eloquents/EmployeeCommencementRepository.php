<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeCommencementRepository;
use App\EmployeeCommencement;

class EmployeeCommencementRepository implements IEmployeeCommencementRepository{
    protected $employeeCommencements;

    public function __construct(EmployeeCommencement $employeeCommencements){
        $this->employeeCommencements = $employeeCommencements;
    }
    
    public function checkCommencementExists($id){
        return $this->employeeCommencements->where('employee_id',$id)->first() == null ? false: true;
    }

    public function getCommencementById($id){
        return [
            'employeeCommencement' => $this->employeeCommencements->where('employee_id',$id)->first()
        ];
    }

    public function storeCommencementById($id){
        $employeeCommencements = $this->employeeCommencements;
        $employeeCommencements->employee_id = $id;
        return [
            'result'=>$employeeCommencements->save(),
            'employeeCommencement' => $employeeCommencements
        ];
    }
}