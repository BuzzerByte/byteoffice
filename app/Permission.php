<?php

namespace App;

// use Zizaco\Entrust\EntrustPermission;

class Permission
{
    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
