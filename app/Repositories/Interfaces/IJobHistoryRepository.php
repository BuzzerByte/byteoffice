<?php

namespace App\Repositories\Interfaces;

interface IJobHistoryRepository{
    public function checkJobHistoryExists($id);
    public function getJobHistoryById($id);
}