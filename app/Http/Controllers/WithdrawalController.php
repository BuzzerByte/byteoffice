<?php

namespace buzzeroffice\Http\Controllers;

use buzzeroffice\Withdrawal;
use buzzeroffice\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdrawals = Withdrawal::all();
        return view('admin.withdrawals.index',['withdrawals'=>$withdrawals]);
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
        $stored = Withdrawal::create([
            'inventory_id' => $request->inv_id,
            'w_quantity'=>$request->w_quantity,
            'project_id'=>$request->project_id,
            'withdrawer'=>Auth::user()->name,
        ]);
        $current_quantity = Inventory::where('id',$request->inv_id)->first()->quantity;
        $update_inventory_quantity = Inventory::where('id',$request->inv_id)->update([
            'quantity' => (int)$current_quantity-(int)$request->w_quantity,
        ]);
        if($stored){

        }else{

        }
        return redirect()->action('InventoryController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \buzzeroffice\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function show(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \buzzeroffice\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdrawal $withdrawal)
    {
        return response()->json($withdrawal);
        
        $edits = Withdrawal::where('id',$withdrawal->id)->get();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \buzzeroffice\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdrawal $withdrawal)
    {
        
        $update = Withdrawal::where('id',$withdrawal->id)->update([
            'w_quantity' => $request->w_quantity,
            'project_id'=>$request->project_id,
            'withdrawer' => Auth::user()->name
        ]);
        $current_quantity = Inventory::where('id',$request->inv_id)->first()->quantity;
        $ori_qty = $request->ori_qty;
        $edited_qty = $request->w_quantity;
        if((int)$ori_qty>(int)$edited_qty){
            $update_inventory_quantity = Inventory::where('id',$request->inv_id)->update([
                'quantity' => (int)$current_quantity+((int)$ori_qty-(int)$edited_qty),
            ]);
        }elseif((int)$ori_qty<(int)$edited_qty){
            $update_inventory_quantity = Inventory::where('id',$request->inv_id)->update([
                'quantity' => (int)$current_quantity-((int)$edited_qty-(int)$ori_qty),
            ]);
        }
        
        $withdrawals = Withdrawal::all();
        return redirect()->route('withdrawals.index',['withdrawals'=>$withdrawals]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \buzzeroffice\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdrawal $withdrawal)
    {
        //
    }

    public function delete(Withdrawal $withdrawal){
        $data = Withdrawal::find($withdrawal->id);

        $current_quantity = Inventory::where('id',$withdrawal->inventory_id)->get();
        
        Inventory::where('id',$withdrawal->inventory_id)->update([
            'quantity'=>(int)$withdrawal->w_quantity+(int)$current_quantity[0]['quantity'],
        ]);
        $data->delete();
        if($data){
            Session::flash('success', 'Withdrawal Data Deleted!');
        }else{
            Session::flash('failure', 'Something went wrong!');
        }
        $withdrawals = Withdrawal::all();
        return redirect()->route('withdrawals.index',['withdrawals'=>$withdrawals]); 
    }
}
