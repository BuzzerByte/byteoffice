<?php

namespace buzzeroffice;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];
    public function roles()
    {
        return $this->belongsToMany('buzzeroffice\Role');
    }
}
