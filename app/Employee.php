<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function hasRole(){
        return $this->role;
    }
}
