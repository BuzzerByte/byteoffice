<?php

namespace buzzeroffice;

use Illuminate\Database\Eloquent\Model;

class EmployeeTermination extends Model
{
    protected $fillable = [
        'employee_id',
        'date',
        'reason',
        'note',
    ];
}
