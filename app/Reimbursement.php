<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Department;
use App\Employee;

class Reimbursement extends Model
{
    //
    protected $fillable = [
        'date',
        'description',
        'amount',
        'employee_id',
        'department_id',
        'm_approved',
        'm_comment',
        'a_approved',
        'a_comment'
    ];

    public function timeFormat($dateTime){
        return Carbon::parse($dateTime)->format('d M Y');
    }

    public function department($id){
        return Department::select('name')->where('id',$id)->first()->name;
    }
    
    public function employee($id){
        return Employee::select('name')->where('id',$id)->first()->name;
    }
}
