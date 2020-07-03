<?php

namespace App;

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
