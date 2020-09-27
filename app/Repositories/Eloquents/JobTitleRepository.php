<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IJobTitleRepository;
use App\JobTitle;

class JobTitleRepository implements IJobTitleRepository{
    protected $jobTitles;

    public function __construct(
        JobTitle $jobTitles
    ){
        $this->jobTitles = $jobTitles;
    }

    public function all(){
        return $this->jobTitles->where('user_id',Auth::user()->id)
                    ->orderBy('created_at','asc')
                    ->get();
    }
}
