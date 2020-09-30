<?php

namespace App\Repositories\Interfaces;

interface IEmployeeDepositRepository{
    public function checkDepositExists($id);
    public function getDepositById($id);
    public function storeDepositById($id);
}