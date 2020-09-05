<?php

namespace App\Repositories\Eloquents;

use App\Tax;
use Auth;
use App\Repositories\Interfaces\ITaxRepository;

class TaxRepository implements ITaxRepository{
    protected $taxes;

    public function __construct(Tax $taxes){
        $this->taxes = $taxes;
    }

    public function all(){
        return $this->taxes->where('user_id',Auth::user()->id)
                        ->orderBy('created_at', 'asc')
                        ->get();
    }
}