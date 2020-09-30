<?php

namespace App\Repositories\Interfaces;

interface IJobHistoryRepository{
    public function checkJobHistoryExists($id);
    public function getJobHistoryById($id);
    public function checkJobHistoryExistByDepartmentId($id);
    public function getJobHistoryByDepartmentId($id);
}