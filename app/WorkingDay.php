<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    //
    protected $fillable = [
        'day',
        'work',
        'user_id'
    ];
}
