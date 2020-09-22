<?php

namespace App\Repositories\Interfaces;

interface IEmployeeLoginRepository{
    public function checkLoginExists($id);
}