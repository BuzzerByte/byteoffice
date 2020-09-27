<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\ILeaveTypeRepository;
use App\LeaveType;
use Auth;

class LeaveTypeRepository implements ILeaveTypeRepository{
    protected $leaveTypes;

    public function __construct(LeaveType $leaveTypes){
        $this->leaveTypes = $leaveTypes;
    }

    public function all(){
        return $this->leaveTypes->where('user_id',Auth::user()->id)->get();
    }
}