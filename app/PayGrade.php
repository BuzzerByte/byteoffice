<?php

namespace buzzeroffice;

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
