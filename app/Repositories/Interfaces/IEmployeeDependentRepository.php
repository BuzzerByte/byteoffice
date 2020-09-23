<?php

namespace App\Repositories\Interfaces;

interface IEmployeeDependentRepository{
    public function checkDependentExists($id);
    public function getDependentById($id);
}