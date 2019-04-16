<?php

namespace buzzeroffice;

use Illuminate\Database\Eloquent\Model;
use buzzeroffice\JobHistory;

class Department extends Model
{
    //
    protected $fillable = [
        'name',
        'description'
    ];

    public function jobHistory(){
        return $this->hasMany('JobHistory');
    }
}
