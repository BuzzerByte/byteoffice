<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\IWorkShiftRepository;
use App\WorkShift;

class WorkShiftRepository implements IWorkShiftRepository{
    protected $workShifts;

    public function __construct(
        WorkShift $workShifts
    ){
        $this->workShifts = $workShifts;
    }

    public function all(){
        return $this->workShifts->where('user_id',Auth::user()->id)
                    ->orderBy('created_at','asc')
                    ->get();
    }
}