<?php

namespace App\Repositories\Eloquents;

use App\QuotationProduct;
use App\Repositories\Interfaces\IQuotationProductRepository;
use Auth;

class QuotationProductRepository implements IQuotationProductRepository{
    protected $quotationProducts;

    public function __construct(QuotationProduct $quotationProducts){
        $this->quotationProducts = $quotationProducts;
    }

    public function store($inventories, $quotation_id){
        for($i=0;$i<$inventories['count'];$i++){
            $quotationProduct = new QuotationProduct;
            $quotationProduct->inventory_id = $inventories['id'][$i];
            $quotationProduct->description = $inventories['desc'][$i];
            $quotationProduct->quantity = $inventories['qty'][$i];
            $quotationProduct->rate = $inventories['rate'][$i];
            $quotationProduct->amount = $inventories['amt'][$i];
            $quotationProduct->quotation_id = $quotation_id;
            $quotationProduct->save();
        }
        return ['result'=>true, 'id'=>$quotation_id];
    }

    public function getByQuotationId($quotation_id){
        return $this->quotationProducts->where('quotation_id',$quotation_id)->get();
    }

    public function update($inventories, $quotation_id){
        // $number_of_sales = count($inv_id);
        for($i=0;$i<$inventories['count'];$i++){
            if(!array_key_exists($i, $inventories['id'])){
                $quotationProduct = new QuotationProduct;
                $quotationProduct->inventory_id = $inventories['id'][$i];
                $quotationProduct->description = $inventories['desc'][$i];
                $quotationProduct->quantity = $inventories['qty'][$i];
                $quotationProduct->rate = $inventories['rate'][$i];
                $quotationProduct->amount = $inventories['amt'][$i];
                $quotationProduct->quotation_id = $quotation_id;
                $quotationProduct->save();
            }else{
                $quotationProduct = QuotationProduct::find($quotation_id);
                $quotationProduct->inventory_id = $inventories['id'][$i];
                $quotationProduct->description = $inventories['desc'][$i];
                $quotationProduct->quantity = $inventories['qty'][$i];
                $quotationProduct->rate = $inventories['rate'][$i];
                $quotationProduct->amount = $inventories['amt'][$i];
                $quotationProduct->quotation_id = $quotation_id;
                $quotationProduct->save();
            }
        }
        $quotation_items = $this->quotationProducts->where('quotation_id',$quotation_id)->get();
        foreach($quotation_items as $item){
            if(!in_array($item->inventory_id,$inventories['id'])){
                $remove = QuotationProduct::find($item->id);
                $remove->delete();
            }
        }
        return ['result'=>true];
    }
}