<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayGrade extends Model
{
    //
    protected $fillable=[
        'name',
        'minimum',
        'maximum'
    ];
}
