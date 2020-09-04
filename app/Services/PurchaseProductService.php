<?php

namespace App\Services;

use App\Repositories\Interfaces\IPurchaseProductRepository;
use Illuminate\Http\Request;
use App\PurchaseProduct;

class PurchaseProductService{
    protected $purchaseProducts;

    public function __construct(
        IPurchaseProductRepository $purchaseProducts
    ){
        $this->purchaseProducts = $purchaseProducts;
    }

    public function getByPurchaseId($purchase_id){
        $this->purchaseProducts->getByPurchaseId($purchase_id);
    }
}