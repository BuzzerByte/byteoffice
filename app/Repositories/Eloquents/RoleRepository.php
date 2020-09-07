<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IRoleRepository;
use App\Role;
use Auth;

class RoleRepository implements IRoleRepository{
    protected $roles;

    public function __construct(Role $roles){
        $this->roles = $roles;
    }

    public function all(){
        return $this->roles->where('user_id',Auth::user()->id)->get();
    }
}