<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IJobCategoryRepository;
use App\JobCategory;
use Auth;

class JobCategoryRepository implements IJobCategoryRepository{
    protected $jobCategories;

    public function __construct(JobCategory $jobCategories){
        $this->jobCategories = $jobCategories;
    }

    public function all(){
        return $this->jobCategories->where('user_id',Auth::user()->id)
                    ->orderBy('created_at','asc')
                    ->get();
    }
}