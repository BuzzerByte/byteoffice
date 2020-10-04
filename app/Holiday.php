<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'start',
        'end',
        'user_id'
    ];
}
