<?php

namespace App\Repositories\Interfaces;

interface IEmployeeLoginRepository{
    public function checkLoginExists($id);
    public function getLoginById($id);
    public function storeLogin($id, $f_name);
}