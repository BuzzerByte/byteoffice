<?php

namespace buzzeroffice;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    //
    protected $fillable = [
        'category'
    ];

    public function jobHistory(){
        return $this->hasMany('JobHistory');
    }
}
