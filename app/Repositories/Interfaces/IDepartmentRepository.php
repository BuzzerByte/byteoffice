<?php

namespace App\Repositories\Interfaces;

interface IDepartmentRepository{
    public function all();
    public function getDepartmentById($id);
}