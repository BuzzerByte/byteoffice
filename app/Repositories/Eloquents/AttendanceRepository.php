<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IAttendanceRepository;
use App\Attendance;

class AttendanceRepository implements IAttendanceRepository{
    protected $attendances;

    public function __construct(
        Attendance $attendances
    ){
        $this->attendances = $attendances;
    }

    public function all(){
        return $this->attendances->leftjoin('employees','attendances.employee_id','employees.id')
                    ->leftjoin('users','employees.user_id','users.id')
                    ->orderBy('attendances.created_at','asc')
                    ->get();
    }

    public function getAttendances($department_id, $date){
        return $this->attendances->where('department_id',$department_id)
                    ->where('date',$date)
                    ->get();
    }
}