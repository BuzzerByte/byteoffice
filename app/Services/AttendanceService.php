<?php

namespace App\Services;

use App\Repositories\Interfaces\IAttendanceRepository;
use App\Repositories\Interfaces\IDepartmentRepository;
use App\Repositories\Interfaces\ILeaveTypeRepository;
use App\Repositories\Interfaces\IEmployeeRepository;
use App\Attendance;

class AttendanceService {
    protected $attendances;

    public function __construct(
        IAttendanceRepository $attendances,
        IDepartmentRepository $departments,
        ILeaveTypeRepository $leaveTypes,
        IEmployeeRepository $employees
    ){
        $this->attendances = $attendances;
        $this->departments = $departments;
        $this->leaveTypes = $leaveTypes;
        $this->employees = $employees;
    }

    public function getDepartments()
    {
        return $this->departments->all();
    }

    public function getAttendances($department_id, $date)
    {
        return $this->attendances->getAttendances($department_id, $date);
    }

    public function getLeaveTypes(){
        return $this->leaveTypes->all();
    }

    public function getEmployees(){
        return $this->employees->all();
    }
}