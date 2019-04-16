<?php

namespace buzzeroffice;

use Illuminate\Database\Eloquent\Model;

class WorkShift extends Model
{
    //
    protected $fillable = [
        'name',
        'from',
        'to'
    ];
}
