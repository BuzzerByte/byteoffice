<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $fillable = [
        'date',
        'department_id',
        'employee_id',
        'leave_id',
        'in',
        'out'
    ];
}
