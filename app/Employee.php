<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'f_name',
        'l_name',
        'dob',
        'marital_status',
        'country',
        'blood_group',
        'id_number',
        'religious',
        'gender',
        'photo',
        'terminate_status',
        'created_at',
        'updated_at'
    ];
}
