<?php

namespace App\Http\Controllers;

use App\Quotation;
use App\Client;
use App\Inventory;
use App\QuotationProduct;
use DB;
use Carbon\Carbon;  
use Session;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotations = Quotation::all();
        return view('admin.quotations.index',['quotations'=>$quotations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $inventories = Inventory::all();
        return view('admin.quotations.create',['clients'=>$clients,'inventories'=>$inventories]);
    }

    public function createWithClient(Client $client){
        $selected_client = $client;
        $clients = Client::all();
        $inventories = Inventory::all();
        return view('admin.quotations.create',['clients'=>$clients,'inventories'=>$inventories,'selected_client'=>$selected_client]);
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
        if($request->total == null){
            $total = 0;
        }else{
            $total = $request->total;
        }
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
        if($request->g_total == null){
            $g_total = 0;
        }else{
            $g_total = $request->g_total;
        }
        $quotation_id = DB::table('quotations')->insertGetId(
            [
                'client_id'=>$request->client_id,
                'estimate_date'=>$request->est_date,
                'expiration_date'=>$request->exp_date,
                'total' => $total,
                'g_total'=>$g_total,
                'tax'=>$tax,
                'discount'=>$discount,
                'status'=>'pending',
                'order_note'=>$request->order_note,
                'order_activities'=>$request->order_activities,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]
        );

        $number_of_sales = count($inv_id);
        for($i=0;$i<$number_of_sales;$i++){
            QuotationProduct::create([
                'inventory_id'=>$inv_id[$i],
                'description'=>$inv_desc[$i],
                'quantity'=>$inv_qty[$i],
                'rate'=>$inv_rate[$i],
                'amount'=>$inv_amount[$i],
                'quotation_id'=>$quotation_id
            ]);
        }
        
        return redirect()->action(
            'QuotationController@index'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        $quotation = Quotation::where('id',$quotation->id)->get();
        $client = Client::where('id',$quotation[0]['client_id'])->get();
        $quotation_products = QuotationProduct::where('quotation_id',$quotation[0]['id'])->get();
        return view('admin.quotations.show',['quotation'=>$quotation,'client'=>$client,'quotation_products'=>$quotation_products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        $quotations = Quotation::where('id',$quotation->id)->get();
        $client = Client::where('id',$quotation->client_id)->get();
        $quotation_products = QuotationProduct::where('quotation_id',$quotation->id)->get();
        $inventories = Inventory::all();
        return view('admin.quotations.edit',['inventories'=>$inventories,'quotation'=>$quotations,'client'=>$client,'quotation_products'=>$quotation_products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        $quotation_id = $request->quotation_id;

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
        if($request->total == null){
            $total = 0;
        }else{
            $total = $request->total;
        }
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
        if($request->g_total == null){
            $g_total = 0;
        }else{
            $g_total = $request->g_total;
        }

        $updateQuotation = Quotation::where('id',$quotation->id)->update([
            'estimate_date'=>$request->est_date,
            'expiration_date'=>$request->exp_date,
            'total' => $request->total,
            'g_total'=>$request->g_total,
            'tax'=>$request->tax,
            'discount'=>$request->discount,
            'order_note'=>$request->order_note,
            'order_activities'=>$request->order_activities,
        ]);
       
        $number_of_sales = count($inv_id);
        for($i=0;$i<$number_of_sales;$i++){
            if(!array_key_exists($i, $quotation_id)){
                QuotationProduct::create(
                    ['inventory_id'=>$inv_id[$i],
                    'description'=>$inv_desc[$i],
                    'quantity'=>$inv_qty[$i],
                    'rate'=>$inv_rate[$i],
                    'amount'=>$inv_amount[$i],
                    'quotation_id'=>$quotation->id]
                );
            }else{
                QuotationProduct::where('id',$quotation_id[$i])->update(
                    ['inventory_id'=>$inv_id[$i],
                    'description'=>$inv_desc[$i],
                    'quantity'=>$inv_qty[$i],
                    'rate'=>$inv_rate[$i],
                    'amount'=>$inv_amount[$i],
                    'quotation_id'=>$quotation->id]
                );
            }
        }
        $quotation_items = QuotationProduct::where('quotation_id',$quotation->id)->get();
        foreach($quotation_items as $item){
            if(!in_array($item->inventory_id,$inv_id)){
                $remove = QuotationProduct::find($item->id);
                $remove->delete();
            }
        }
        return redirect()->action(
            'QuotationController@index'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        //
    }

    public function delete(Quotation $quotation){
        
        $data = Quotation::find($quotation->id);
        $data->delete();
        if($data){
            Session::flash('success', 'Quotation Data Deleted!');
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        
        return redirect()->action('QuotationController@index');    
    }
}
