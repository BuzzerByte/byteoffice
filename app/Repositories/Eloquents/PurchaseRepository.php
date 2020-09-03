<?php

namespace App\Repositories\Eloquents;

use App\Purchase;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IPurchaseRepository;

class PurchaseRepository implements IPurchaseRepository
{
    protected $purchases;

    public function __construct(Purchase $purchases){
        $this->purchases = $purchases;
    }
   
    /**
     * Get all of the order for the given user.
     *
     * @param  Order  $order
     * @return Collection
     */
    public function all()
    {
        
    }

    public function getPurchaseTotal($purchase_id){
        return $this->purchases->select('g_total')->where('id',$purchase_id)->get();
    }

    public function updatePaid($purchase_id,$total, $balance){
        $purchase = $this->purchases->find($purchase_id);
        $purchase->paid = $total;
        $purchase->balance = $balance;
        return $purchase->save();
    }

    public function getById($purchase_id){
        return $this->purchases->find($purchase_id);
    }
}