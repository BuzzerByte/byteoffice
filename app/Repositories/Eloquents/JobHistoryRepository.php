<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IJobHistoryRepository;
use App\JobHistory;

class JobHistoryRepository implements IJobHistoryRepository{
    protected $jobHistories;

    public function __construct(JobHistory $jobHistories){
        $this->jobHistories = $jobHistories;
    }

    public function checkJobHistoryExists($id){
        return $this->jobHistories->where('employee_id',$id)->first() == null ? false:true;
    }

    public function getJobHistoryById($id){
        return $this->jobHistories->where('employee_id',$id)->get();
    }

    public function checkJobHistoryExistByDepartmentId($id){
        return $this->jobHistories->where('department_id',$id)->first() == null ? false:true;
    }

    public function getJobHistoryByDepartmentId($id){
        return $this->jobHistories->where('department_id',$id)->get();
    }
}