<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeDependent extends Model
{
    protected $fillable=[
        'name',
        'relationship',
        'dob',
        'employee_id'
    ];
}
