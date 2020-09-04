<?php

namespace App\Repositories\Eloquents;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\IPurchaseProductRepository;
use App\PurchaseProduct;

class PurchaseProductRepository implements IPurchaseProductRepository
{
    protected $purchaseProducts;

    public function __construct(PurchaseProduct $purchaseProducts){
        $this->purchaseProducts = $purchaseProducts;
    }

    public function store($id, $desc, $qty, $rate, $amt, $purchase_id){
        $purchaseProducts = new PurchaseProduct;
        $purchaseProducts->inventory_id = $id;
        $purchaseProducts->description = $desc;
        $purchaseProducts->quantity = $qty;
        $purchaseProducts->rate = $rate;
        $purchaseProducts->amount = $amt;
        $purchaseProducts->purchase_id = $purchase_id;
        return ['result'=>$purchaseProducts->save(),'id'=>$purchaseProducts->id];
    }

    public function getByPurchaseId($purchase_id){
        return $this->purchaseProducts->where('purchase_id',$purchase_id)->get();
    }
}