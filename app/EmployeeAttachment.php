<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeAttachment extends Model
{
    protected $fillable = [
        'name',
        'description',
        'added_by',
        'employee_id'
    ];
}
