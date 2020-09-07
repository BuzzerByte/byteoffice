<?php

namespace App\Services;

use App\Repositories\Interfaces\IRoleRepository;

class EmployeeService{
    protected $roles;

    public function __construct(
        IRoleRepository $roles
    ){
        $this->roles = $roles;
    }

    public function getRoles(){
        return $this->roles->all();
    }
}