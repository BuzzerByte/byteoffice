<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAttachment extends Model
{
    protected $fillable = [
        'name',
        'description',
        'added_by',
        'user_id'
    ];
}
