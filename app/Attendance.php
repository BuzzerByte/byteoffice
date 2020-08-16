<?php

namespace App;
use App\Department;
use App\User;
use App\Leavetype;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //
    protected $fillable = [
        'date',
        'department_id',
        'employee_id',
        'leave_id',
        'in',
        'out'
    ];

    public function department($id){
        return Department::select('name')->where('id',$id)->first() == '' ? '':Department::select('name')->where('id',$id)->first()->name;
    }

    public function employee($id){
        return User::select('name')->where('id_number',$id)->first() == ''?'':User::select('name')->where('id_number',$id)->first()->name;
    }

    public function leave($id){
        return Leavetype::where('id',$id)->first()->name;
    }
}
