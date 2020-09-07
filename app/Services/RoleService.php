<?php

namespace App\Services;

use App\Repositories\Interfaces\IRoleRepository;

class RoleService{
    protected $roles;

    public function __construct(IRoleRepository $roles){
        $this->roles = $roles;
    }
}