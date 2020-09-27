<?php

namespace App\Repositories\Interfaces;

interface IAttendanceRepository{
    public function all();
    public function getAttendances($department_id, $date);
}