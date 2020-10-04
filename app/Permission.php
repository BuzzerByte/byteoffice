<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description',
        'user_id'
    ];
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
