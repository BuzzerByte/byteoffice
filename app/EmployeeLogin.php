<?php

namespace buzzeroffice;

use Illuminate\Database\Eloquent\Model;

class EmployeeLogin extends Model
{
    protected $fillable=[
        'name',
        'password',
        'active',
        'employee_id'
    ];
}
