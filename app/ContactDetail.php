<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    protected $fillable = [
        'street1',
        'street2',
        'city',
        'state',
        'zip',
        'country',
        'home_tel',
        'work_email',
        'work_tel',
        'other_email',
        'mobile',
        'employee_id'
    ];
}
