<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\PurchaseProduct;
use Illuminate\Http\Request;
use DB;
use Excel;
use Carbon\Carbon;
use File;   
use App\Inventory;
use App\Vendor;
use App\Payment;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Exports\PurchaseExport;

class PurchaseController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();
        $payments = Payment::all();
        $vendor = Vendor::all();
        return view('admin.purchases.index',['purchases'=>$purchases,'payments'=>$payments,'vendor'=>$vendor]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendors = Vendor::all();
        $inventories = Inventory::all();
        return view('admin.purchases.create',['vendors'=>$vendors,'inventories'=>$inventories]);
    }

    public function createWithVendor(Vendor $vendor){
        $selected_vendor = $vendor;
        $vendors = Vendor::all();
        $inventories = Inventory::all();
        return view('admin.purchases.create',['vendors'=>$vendors,'inventories'=>$inventories,'selected_vendor'=>$selected_vendor]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inv_id = $request->inventory_id;
        array_splice($inv_id,0,1);
        array_splice($inv_id,count($inv_id)-1,1);

        $inv_desc = $request->inventory_desc;
        array_splice($inv_desc,0,1);
        array_splice($inv_desc,count($inv_desc)-1,1);

        $inv_qty = $request->inventory_qty;
        array_splice($inv_qty,0,1);
        array_splice($inv_qty,count($inv_qty)-1,1);

        $inv_rate = $request->inventory_rate;
        array_splice($inv_rate,0,1);
        array_splice($inv_rate,count($inv_rate)-1,1);

        $inv_amount = $request->inventory_amount;
        array_splice($inv_amount,0,1);
        array_splice($inv_amount,count($inv_amount)-1,1);
        if($request->tax == null){
            $tax = 0;
        }else{
            $tax = $request->tax;
        }
        if($request->discount == null){
            $discount = 0;
        }else{
            $discount = $request->discount;
        }
        if($request->shipping == null){
            $transport = 0;
        }else{
            $transport = $request->shipping;
        }
        if($request->total == null){
            $total = 0;
        }else{
            $total = $request->total;
        }
        if($request->g_total == null){
            $g_total = 0;
        }else{
            $g_total = $request->g_total;
        }
        $purchase_id = DB::table('purchases')->insertGetId(
            [
                'vendor_id'=>(int)$request->vendorId,
                'b_reference'=>$request->b_reference,
                'status'=>'pending_received',
                'note'=>$request->order_note,
                'total'=>$total,
                'discount'=>$discount,
                'tax'=>$tax,
                'transport' => $transport,
                'g_total'=>$g_total,
                'paid' => 0.00,
                'balance' => 0.00,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]
        );

        $number_of_sales = count($inv_id);
        for($i=0;$i<$number_of_sales;$i++){
            PurchaseProduct::create([
                'inventory_id'=>$inv_id[$i],
                'description'=>$inv_desc[$i],
                'quantity'=>$inv_qty[$i],
                'rate'=>$inv_rate[$i],
                'amount'=>$inv_amount[$i],
                'purchase_id'=>$purchase_id
            ]);
        }
        
        return redirect()->action(
            'PurchaseController@show', ['id' => $purchase_id]
        );
    }

    public function getBalance(Purchase $purchase){
        $leftAmount=$purchase->g_total-$purchase->paid;
        return response()->json($leftAmount);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        $purchases = Purchase::where('id',$purchase->id)->get();
        $purchase_products = PurchaseProduct::where('purchase_id',$purchase->id)->get();
        $vendor = Vendor::where('id',$purchases[0]['vendor_id'])->get();
        $payments = Payment::where('purchase_id',$purchase->id)->get();
        
        return view('admin.purchases.show',['purchase'=>$purchases,'purchase_products'=>$purchase_products,'vendors'=>$vendor,'payments'=>$payments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $purchases = Purchase::where('id',$purchase->id)->get();
        $purchaseProducts = PurchaseProduct::where('purchase_id',$purchase->id)->get();
        return response()->json(['purchase'=>$purchases,'purchaseProducts'=>$purchaseProducts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    } 
    
    public function export(){
        Excel::create('Purchase List', function($excel) {   
            $excel->sheet('List', function($sheet) {      
                $data = array();
                $arr = Purchase::all();
                $temp = array();
                $sheet->row(1, array(
                    'Vendor','Billing Reference','Status','Note','Total','Discount','Tax','Transport','Grang Total','Paid','Balance','Created At','Updated At'
                ));
                foreach($arr as $index=>$row){
                    $vendor = Vendor::find($row['vendor_id']);
                    array_push($temp, $vendor->name);
                    array_push($temp, $row['b_reference']);
                    array_push($temp, $row['status']);
                    array_push($temp, $row['note']);
                    array_push($temp, $row['total']);
                    array_push($temp, $row['discount']);
                    array_push($temp, $row['tax']);
                    array_push($temp, $row['transport']);
                    array_push($temp, $row['g_total']);
                    array_push($temp, $row['paid']);
                    array_push($temp, $row['balance']);
                    array_push($temp, $row['created_at']);
                    array_push($temp, $row['updated_at']);
                    $sheet->appendRow($temp);
                    $temp = array();
                } 
            });
        })->export('csv');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        Purchase::find($purchase->id)->delete();
        return response()->json(['success'=>'deleted successfully']);
    }
 
    public function delete(Purchase $purchase){
        $deleted = Purchase::find($purchase->id)->delete();
        $vendors = Vendor::all();
        $inventories = Inventory::all();
        if($deleted){
            Session::flash('success','Purchase record deleted!');
        }else{
            Session::flash('failure','Something went wrong!');
        }
        $purchases = Purchase::all();
        $payments = Payment::all();
        $vendor = Vendor::all();
        return redirect()->route('purchases.index',['purchases'=>$purchases,'payments'=>$payments,'vendor'=>$vendor]);
    }
}
