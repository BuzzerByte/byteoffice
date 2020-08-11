<?php

namespace App\Http\Controllers;

use App\Payment;
use Session;
use Carbon\Carbon;
use App\Purchase;
use App\PurchaseProduct;
use App\Vendor;
use App\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function add(Request $request){
        if ($request->hasFile('bill')) {
            $file = $request->file('bill');
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('/payments');
            $file->move($destinationPath, $name);
        }else{
            $name = "";
        }
        $date = Carbon::parse($request->payment_date)->format('Y-m-d');
        if(isset($request->invoiceId)){
            $stored = Payment::create([
                'date' => $date,
                'reference_no' => $request->order_ref,
                'received_amt' => $request->amount,
                'attachment' => $name,
                'payment_method' => $request->payment_method,
                'cc_name'=>$request->cc_name,
                'cc_number'=>$request->cc_number,
                'cc_type'=>$request->cc_type,
                'cc_month'=>$request->cc_month,
                'cc_year'=>$request->cc_year,
                'cvc'=>$request->cvc,
                'payment_ref'=>$request->payment_ref,
                'order_id'=>(int)$request->invoiceId,
            ]);
            
            if($stored){
                $total_paid = Payment::select('received_amt')->where('order_id',(int)$request->invoiceId)->get();
                $total_of_purchase = Order::select('g_total')->where('id',(int)$request->invoiceId)->get();
                // return response()->json($total_of_purchase);
                if(!empty($total_paid)){
                    $total = 0;
                    foreach($total_paid as $paid){
            
                        $total += $paid->received_amt;             
                    }
                    $balance = $total_of_purchase[0]['g_total'] - $total;
                    $update_purchase = Order::where('id',$request->invoiceId)->update([
                        'paid'=>$total,
                        'balance'=>$balance
                    ]);
                }
                Session::flash('success', 'Payment added!');
            }else{
                Session::flash('failure', 'Something went wrong');
            }
            return redirect()->route('orders.show',$request->invoiceId);
            // return redirect()->action(
            //     'OrderController@show', ['id' => $request->invoiceId]
            // );
        }else{
            $stored = Payment::create([
                'date' => $request->payment_date,
                'reference_no' => $request->order_ref,
                'received_amt' => $request->amount,
                'attachment' => $name,
                'payment_method' => $request->payment_method,
                'cc_name'=>$request->cc_name,
                'cc_number'=>$request->cc_number,
                'cc_type'=>$request->cc_type,
                'cc_month'=>$request->cc_month,
                'cc_year'=>$request->cc_year,
                'cvc'=>$request->cvc,
                'payment_ref'=>$request->payment_ref,
                'purchase_id'=>(int)$request->purchaseId,
            ]);
            if($stored){
                $total_paid = Payment::select('received_amt')->where('purchase_id',(int)$request->purchaseId)->get();
                $total_of_purchase = Purchase::select('g_total')->where('id',(int)$request->purchaseId)->get();
                if(!empty($total_paid)){
                    $total = 0;
                    foreach($total_paid as $paid){
            
                        $total += $paid->received_amt;             
                    }
                    $balance = $total_of_purchase[0]['g_total'] - $total;
                    $update_purchase = Purchase::where('id',$request->purchaseId)->update([
                        'paid'=>$total,
                        'balance'=>$balance
                    ]);
                }
                Session::flash('success', 'Payment added!');
            }else{
                Session::flash('failure', 'Something went wrong');
            }
            return redirect()->route('purchases.show',$request->purchaseId);
            // return redirect()->action('PurchaseController@show',['id'=>$request->purchaseId]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     * 
     */
    public function show(Payment $payment)
    {
       $payment = Payment::where('id',$payment->id)->get();
       $purchase = Purchase::where('id',$payment[0]['purchase_id'])->get();
       $invoice = Order::where('id',$payment[0]['order_id'])->get();
       return response()->json(['payment'=>$payment,'purchase'=>$purchase,'invoice'=>$invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $date = Carbon::parse($request->payment_date)->format('Y-m-d');
        $total = 0;
        
        $name = "";
        if ($request->hasFile('bill')) {
            $image = $request->file('bill');
            $name = $image->getClientOriginalName();
            $destinationPath = public_path('/payments');
            $image->move($destinationPath, $name);
        }else{
            $org_img = Payment::select('attachment')->where('id',$payment->id)->get();
            $name = $org_img[0]['attachment'];
        }
        $updatePayment = Payment::where('id',$payment->id)
        ->update([
            'date' => $date,
            'reference_no'=> $request->order_ref,
            'received_amt'=>$request->amount,
            'attachment'=>$name,
            'payment_method'=>$request->payment_method,
            'cc_name'=>$request->cc_name,
            'cc_number'=>$request->cc_number,
            'cc_type'=>$request->cc_type,
            'cc_month'=>$request->cc_month,
            'cc_year'=>$request->cc_year,
            'cvc'=>$request->cvc
        ]);
        if(isset($payment->purchase_id)){
            $payments = Payment::where('purchase_id',$payment->purchase_id)->get();
            foreach($payments as $payment){
                $total += $payment->received_amt;
            }
            $purchase = Purchase::where('id',$payment->purchase_id)->get();
            $updatePurchase = Purchase::where('id',$payment->purchase_id)->update([
                'paid' => $total,
                'balance' => $purchase[0]['g_total'] - $total
            ]);
            if($updatePurchase){
                Session::flash('success', 'Payment Updated!');
            }else{
                Session::flash('failure', 'Something went wrong!');
            }
            return redirect()->route('purchases.show',$payment->purchase_id);
            // return redirect()->action(
            //     'PurchaseController@show', ['id' => $payment->purchase_id]
            // );
        }else{
            $payments = Payment::where('order_id',$payment->order_id)->get();
            foreach($payments as $payment){
                $total += $payment->received_amt;
            }
            $order = Order::where('id',$payment->order_id)->get();
            $updateOrder = Order::where('id',$payment->order_id)->update([
                'paid' => $total,
                'balance' => $order[0]['g_total'] - $total
            ]);
            if($updateOrder){
                Session::flash('success', 'Payment Updated!');
            }else{
                Session::flash('failure', 'Something went wrong!');
            }
            return redirect()->route('orders.show',$payment->order_id);
            // return redirect()->action(
            //     'OrderController@show', ['id' => $payment->order_id]
            // );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function delete(Payment $payment){
        if(isset($payment->purchase_id)){
            $purchase = Purchase::where('id',$payment->purchase_id)->get();
            $updatePurchase = Purchase::where('id',$payment->purchase_id)->update([
                'paid' => $purchase[0]['paid']-$payment->received_amt,
                'balance' => $purchase[0]['balance']+$payment->received_amt
            ]);
            $data = Payment::find($payment->id);
            $data->delete();
            if($data){
                Session::flash('success', 'Payment Data Deleted!');
            }else{
                Session::flash('failure', 'Something went wrong!');
            }
            return redirect()->route('purchases.show',$payment->purchase_id);
            // return redirect()->action(
            //     'PurchaseController@show', ['id' => $payment->purchase_id]
            // );
        }else{
            $invoice_id = $payment->order_id;
            $order = Order::where('id',$invoice_id)->get();
            $updateOrder = Order::where('id',$invoice_id)->update([
                'paid' => $order[0]['paid']-$payment->received_amt,
                'balance' => $order[0]['balance']+$payment->received_amt
            ]);
            $data = Payment::find($payment->id);
            $data->delete();
            if($data){
                Session::flash('success', 'Payment Data Deleted!');
            }else{
                Session::flash('failure', 'Something went wrong!');
            }
            return redirect()->route('orders.show',$invoice_id);
            // return redirect()->action(
            //     'OrderController@show', ['id' => $invoice_id]
            // );
        }
        
    }
}
