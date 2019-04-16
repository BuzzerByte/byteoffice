<?php

namespace buzzeroffice;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
        'name',
        'rate',
        'type',
    ];
}
