<?php

namespace App\Repositories\Interfaces;

interface IEmployeeSupervisorRepository{
    public function checkSupervisorsExistsById($id);
    public function getSupervisoryById($id);
}