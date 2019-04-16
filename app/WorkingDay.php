<?php

namespace buzzeroffice;

use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    //
    protected $fillable = [
        'day',
        'work'
    ];
}
