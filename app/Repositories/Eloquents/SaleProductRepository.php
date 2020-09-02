<?php

namespace App\Repositories\Eloquents;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\ISaleProductRepository;
use App\SaleProduct;

class SaleProductRepository implements ISaleProductRepository
{
    protected $saleProducts;

    public function __construct(SaleProduct $saleProducts){
        $this->saleProducts = $saleProducts;
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

    public function storeByOrder($inventories, $order_id){
        for($i = 0; $i < $inventories['count']; $i++){
            $saleProduct = new SaleProduct;
            $saleProduct->inventory_id = $inventories['id'][$i];
            $saleProduct->description = $inventories['desc'][$i];
            $saleProduct->quantity = $inventories['qty'][$i];
            $saleProduct->rate = $inventories['rate'][$i];
            $saleProduct->amount = $inventories['amt'][$i];
            $saleProduct->invoice_id = $order_id;
            if($saleProduct->save()){
                continue;
            }else{
                return ['result'=>false];
            }
        }
        return ['result'=>true, 'order_id'=>$order_id];
    }

    public function getByOrder($order_id){
        return $this->saleProducts->where('invoice_id',$order_id)->get();
    }
}