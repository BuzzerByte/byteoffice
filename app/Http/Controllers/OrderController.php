<?php

namespace App\Http\Controllers;

use App\Order;
use App\Client;
use App\Inventory;
use App\SaleProduct;
use App\Payment;
use App\Quotation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Session;
use Response;
use Excel;
use File;
use DB;
use App\Exports\OrderExport;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice = Order::all();
        $payments = Payment::all();
        return view('admin.orders.index',['invoice'=>$invoice,'payments'=>$payments]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventories = Inventory::all();
        $clients = Client::all();
        return view('admin.orders.create',['inventories'=>$inventories,'clients'=>$clients]);
    }

    public function createWithClient(Client $client){
        $selected_client = $client;
        $inventories = Inventory::all();
        $clients = Client::all();
        return view('admin.orders.create',['inventories'=>$inventories,'clients'=>$clients,'selected_client'=>$selected_client]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function process()
    {
        $processing_order = Order::where('status','processing_order')->get();
        return view('admin.orders.process',['invoice'=>$processing_order]);
    }

    public function updateStatusToShipping(Order $order){
        $updateStatus = Order::where('id',$order->id)->update([
            'status' => 'awaiting_delivery'
        ]);
        return redirect()->route('orders.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        $pending_order = Order::where('status','awaiting_delivery')->get();
        return view('admin.orders.pending',['invoice'=>$pending_order]);
    }

    public function updateStatusToShipped(Order $order){
        $updateStatus = Order::where('id',$order->id)->update([
            'status'=>'delivery_done'
        ]);
        return redirect()->route('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deliver()
    {
        $delivered_order = Order::where('status','delivery_done')->get();
        return view('admin.orders.deliver',['invoice'=>$delivered_order]);
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
        $invoice_id = DB::table('orders')->insertGetId(
            [
                'client_id'=>$request->client_id,
                'invoice_date'=>$request->invoice_date,
                'due_date'=>$request->due_date,
                'total'=>$request->total,
                'g_total'=>$request->g_total,
                'tax'=>$request->tax,
                'discount'=>$request->discount,
                'receive_amt'=>0,
                'amt_due'=>0,
                'paid'=>0,
                'balance'=>0,
                'status'=>'processing_order',
                'order_note'=>$request->order_note,
                'order_activities'=>$request->order_activities,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]
        );

        $number_of_sales = count($inv_id);
        for($i=0;$i<$number_of_sales;$i++){
            SaleProduct::create([
                'inventory_id'=>$inv_id[$i],
                'description'=>$inv_desc[$i],
                'quantity'=>$inv_qty[$i],
                'rate'=>$inv_rate[$i],
                'amount'=>$inv_amount[$i],
                'invoice_id'=>$invoice_id
            ]);
        }
        return redirect()->route('orders.show',$invoice_id);
        // return redirect()->action(
        //     'OrderController@show', ['id' => $invoice_id]
        // );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        
        $invoice = Order::where('id',$order->id)->get();
        $sale_product = SaleProduct::where('invoice_id',$order->id)->get();
        $client = Client::where('id',$invoice[0]['client_id'])->get();
        $payments = Payment::where('order_id',$order->id)->get();
        return view('admin.orders.show',['invoice'=>$invoice,'sale_products'=>$sale_product,'client'=>$client,'payments'=>$payments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $inventories = Inventory::all();
        $invoice = Order::where('id',$order->id)->get();
        $sale_product = SaleProduct::where('invoice_id',$order->id)->get();
        $client = Client::where('id',$invoice[0]['client_id'])->get();
        return view('admin.orders.edit',['invoice'=>$invoice,'clients'=>$client,'sale_product'=>$sale_product,'inventories'=>$inventories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $sale_id = $request->sale_id;

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

        $paid = Order::select('paid')->where('id',$order->id)->first()->paid;
        $updateInvoice = Order::where('id',$order->id)->update([
            'invoice_date'=>$request->invoice_date,
            'due_date'=>$request->due_date,
            'total'=>$request->total,
            'g_total'=>$request->g_total,
            'tax'=>$request->tax,
            'balance'=>$request->g_total - $paid,
            'discount'=>$request->discount,
            'order_note'=>$request->order_note,
            'order_activities'=>$request->order_activities,
        ]);
        
        $number_of_sales = count($inv_id);
        
        for($i=0;$i<$number_of_sales;$i++){
            if(!array_key_exists($i, $sale_id)){
                SaleProduct::create(
                    ['inventory_id'=>$inv_id[$i],
                    'description'=>$inv_desc[$i],
                    'quantity'=>(int)$inv_qty[$i],
                    'rate'=>$inv_rate[$i],
                    'amount'=>$inv_amount[$i],
                    'invoice_id'=>$order->id]
                );
            }else{
                SaleProduct::where('id',$sale_id[$i])->update(
                    
                    ['inventory_id'=>$inv_id[$i],
                    'description'=>$inv_desc[$i],
                    'quantity'=>(int)$inv_qty[$i],
                    'rate'=>$inv_rate[$i],
                    'amount'=>$inv_amount[$i],
                    'invoice_id'=>$order->id]
                );
            }
        }
        $sale_items = SaleProduct::where('invoice_id',$order->id)->get();
        foreach($sale_items as $item){
            if(!in_array($item->inventory_id,$inv_id)){
                $remove = SaleProduct::find($item->id);
                $remove->delete();
            }
        }
        return redirect()->route('orders.show',$order->id);
        // return redirect()->action(
        //     'OrderController@show', ['id' => $order->id]
        // );
    }

    public function exportOrder(){
        return (new OrderExport)->download('invoices.csv');
    }

    public function exportQuotation(){
        Excel::create('Quotation List', function($excel) {   
            $excel->sheet('List', function($sheet) {      
                $data = array();
                $arr = Quotation::all();
                $temp = array();
                $sheet->row(1, array(
                    'Client','Invoice Date','Due Date','Total','Grand Total','Tax','Discount','Paid','Balance','Receive Amount','Amount Due','Tracking No','Delivery Person','Status','Order Note','Order Activities','Created At','Updated At'
                ));
                foreach($arr as $index=>$row){
                    $vendor = Client::find($row['client_id']);
                    array_push($temp, $vendor->name);
                    array_push($temp, $row['estimate_date']);
                    array_push($temp, $row['expiration_date']);
                    array_push($temp, $row['total']);
                    array_push($temp, $row['g_total']);
                    array_push($temp, $row['tax']);
                    array_push($temp, $row['discount']);
                    array_push($temp, $row['status']);
                    array_push($temp, $row['order_note']);
                    array_push($temp, $row['order_activities']);
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function delete(Order $order){
        $data = Order::find($order->id);
        $data->delete();
        if($data){
            flash()->success('Invoice Data Deleted!');
        }else{
            flash()->error('Something went wrong!');    
        }
        $inventories = Inventory::all();
        $clients = Client::all();
        // return redirect()->route('orders.i',$invoice_id);
        return redirect()->action('OrderController@index',['inventories'=>$inventories,'clients'=>$clients]);    
    }
}
