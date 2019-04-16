<?php

namespace buzzeroffice;

use Illuminate\Database\Eloquent\Model;

class EmployeeCommencement extends Model
{
    protected $fillable = [
        'join_date',
        'probation_end',
        'dop',
        'employee_id'
    ];
}
