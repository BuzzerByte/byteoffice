<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IDepartmentRepository;
use App\Department;
use Auth;

class DepartmentRepository implements IDepartmentRepository{
    protected $departments;

    public function __construct(
        Department $departments
    ){
        $this->departments = $departments;
    }

    public function all(){
        return $this->departments->where('user_id', Auth::user()->id)
                    ->orderBy('created_at','asc')
                    ->get();
    }
}