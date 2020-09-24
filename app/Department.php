<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JobHistory;
use App\Department;

class Department extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function jobHistory(){
        return $this->hasMany('JobHistory');
    }
}
