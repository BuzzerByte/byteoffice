<?php

namespace App\Services;

use App\Repositories\Interfaces\IPurchaseRepository;
use Illuminate\Http\Request;
use App\Purchase;

class PurchaseService {
    protected $purchases;

    public function __construct(
        IPurchaseRepository $purchases
    ){
        $this->purchases = $purchases;
    }

    public function getPurchaseTotal($purchase_id){
        return $this->purchases->getPurchaseTotal($purchase_id);
    }

    public function updatePaid($purchase_id,$total, $balance){
        return $this->purchases->updatePaid($purchase_id,$total, $balance);
    }

    public function getById($purchase_id){
        return $this->purchases->getById($purchase_id);
    }
}