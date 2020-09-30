<?php

namespace App\Repositories\Interfaces;

interface IEmployeeSubordinateRepository{
    public function checkSubordinatesExists($id);
    public function getSubordinateById($id);
}