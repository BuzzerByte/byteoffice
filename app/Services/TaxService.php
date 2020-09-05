<?php

namespace App\Services;

use App\Repositories\Interfaces\ITaxRepository;

class TaxService{
    protected $taxes;

    public function __construct(
        ITaxRepository $taxes
    ){
        $this->taxes = $taxes;
    }

    public function all(){
        return $this->taxes->all();
    }
}