<?php

namespace App\Repositories\Interfaces;

interface IEmployeeSalaryRepository{
    public function checkSalaryExists($id);
    public function getSalaryById($id);
    public function storeSalaryById($id);
}