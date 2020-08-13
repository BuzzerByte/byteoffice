<?php

namespace App\Http\Controllers;

use App\PurchaseProduct;
use App\Inventory;
use App\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use App\Exports\PurchaseProductExport;

class PurchaseProductController extends Controller
{
    /**
     * Display a listing of the resource.s
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();
        $purchaseproducts = PurchaseProduct::all();
        
        return view('admin.purchases.receive',['purchases'=>$purchases,'purchaseproducts'=>$purchaseproducts]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->data_items as $purchase_item){
            $inventory = Inventory::select('name')->where('id',$purchase_item[0])->get();
            $purchase = PurchaseProduct::create([
                'name' => $inventory[0]['name'],
                'description' => $purchase_item[1],
                'quantity' => $purchase_item[2],
                'rate' => $purchase_item[3],
                'amount' => $purchase_item[4],
                'purchase_id' => (int)$purchase_item[5]
            ]);
        }
        if($purchase){
            return response()->json('success');
        }else{
            return response()->json('failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseProduct  $purchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseProduct $purchaseProduct)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseProduct  $purchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseProduct $purchaseProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseProduct  $purchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseProduct $purchaseProduct)
    {
        
    }

    public function updateReceivedAmt(Request $request){
        $count = count($request->qty);
        $total_received = 0;
        $total_quantity = 0;
        for($i = 0; $i< $count; $i++){
            $purchaseQty = PurchaseProduct::select('quantity','receive')->where('id',(int)$request->purchase_prod_id[$i])->get();
            
            $total_received += (int)$request->qty[$i];
            $total_quantity += $purchaseQty[0]['quantity'];
            
            $purchaseProds = PurchaseProduct::where('purchase_id',$request->purchaseId)
                                            ->where('id',(int)$request->purchase_prod_id[$i])
                                            ->update([
                                                'receive' => (int)$request->qty[$i] + (int)$purchaseQty[0]['receive'],
                                                'receiver' => Auth::user()->name
                                            ]);
            
        }

        if($total_received < $total_quantity && $total_received > 0){
            $status = "partial_received";
        }else if($total_received == $total_quantity){
            $status = "received";
        }else{
            $status = "pending_received";
        }
        
        $updatePurchaseStatus = Purchase::select('status')->where('id',(int)$request->purchaseId)
                                            ->update([
                                                'status' => $status,
                                            ]);
       
        if($purchaseProds){
            Session::flash('success', 'Purchased Product Updated!');
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        return redirect()->route('purchases.show',$request->purchaseId);
        // return redirect()->action('PurchaseController@show',['id'=>$request->purchaseId]);
    }

    public function updateReturnAmt(Request $request){
        $count = count($request->return);
        $total_returned = 0;
        $total_quantity = 0;
        for($i=0;$i<$count;$i++){
            $purchaseQty = PurchaseProduct::select('quantity','return')->where('id',(int)$request->purchase_prod_id[$i])->get();
            $total_returned += (int)$request->return[$i];
            $total_quantity += $purchaseQty[0]['quantity'];
            $purchaseProds = PurchaseProduct::where('purchase_id',$request->purchaseId)
                                            ->where('id',(int)$request->purchase_prod_id[$i])
                                            ->update([
                                                'return' => (int)$request->return[$i] +  (int)$purchaseQty[0]['return']
                                            ]);
        }
        if($total_returned < $total_quantity && $total_returned > 0){
            $status = "partial_received";
        }else if($total_returned == $total_quantity){
            $status = "return_purchase";
        }else{
            $status = "pending_received";
        }
        
        $updatePurchaseStatus = Purchase::select('status')->where('id',(int)$request->purchaseId)
                                            ->update([
                                                'status' => $status,
                                            ]);
        if($purchaseProds){
            Session::flash('success','Purchased Product Updated!');
        }else{
            Session::flash('failure','Something went wrong!');
        }
        return redirect()->route('purchases.show',$request->purchaseId);
        // return redirect()->action('PurchaseController@show',['id'=>$request->purchaseId]);
    }

    public function getName(PurchaseProduct $purchaseProduct){
        return response()->json(Inventory::where('id',$purchaseProduct->inventory_id)->first()->name);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseProduct  $purchaseProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseProduct $purchaseProduct)
    {
        //
    }

    public function export(){
        return (new PurchaseProductExport)->download('receive.csv');
    }
}
