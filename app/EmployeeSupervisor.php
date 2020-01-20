<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSupervisor extends Model
{
    protected $fillable=[
        'department_id',
        'supervisor_id',
        'employee_id'
    ];
}
