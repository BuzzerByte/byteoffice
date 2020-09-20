<?php

namespace App\Repositories\Interfaces;

use App\Employee;
use App\EmployeeAttachment;

interface IEmployeeAttachmentRepository{
    public function checkAttachmentsExists(Employee $employee);
}