<?php

namespace App\Services;

use App\Repositories\Interfaces\IAttendanceRepository;
use App\Repositories\Interfaces\IDepartmentRepository;
use App\Repositories\Interfaces\ILeaveTypeRepository;
use App\Attendance;

class AttendanceService {
    protected $attendances;

    public function __construct(
        IAttendanceRepository $attendances,
        IDepartmentRepository $departments,
        ILeaveTypeRepository $leaveTypes
    ){
        $this->attendances = $attendances;
        $this->departments = $departments;
        $this->leaveTypes = $leaveTypes;
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
}