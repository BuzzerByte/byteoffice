<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IEmployeeAttachmentRepository;
use App\EmployeeAttachment;
use App\Employee;

class EmployeeAttachmentRepository implements IEmployeeAttachmentRepository{
    protected $employeeAttachments;

    public function __construct(
        EmployeeAttachment $employeeAttachments
    ){
        $this->employeeAttachment = $employeeAttachments;
    }

    public function checkAttachmentsExists(Employee $employee){
        return $this->employeeAttachment->where('employee_id',$employee->id)->first() == null ? false: true;
    }
}