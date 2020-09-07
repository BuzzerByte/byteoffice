<?php

namespace App\Services;

use App\Repositories\Interfaces\IWithdrawalRepository;
use App\Repositories\Interfaces\IInventoryRepository;

class WithdrawalService{
    protected $withdrawals;
    protected $inventories;

    public function __construct(
        IWithdrawalRepository $withdrawals,
        IInventoryRepository $inventories
    ){
        $this->withdrawals = $withdrawals;
        $this->inventories = $inventories;
    }

    public function all(){
        return $this->withdrawals->all();
    }

    public function store(Request $request){
        $withdrawal = $this->withdrawals->store($request);
        $current_quantity = $this->inventories->getQuantity($request->inv_id);
        $inventory = $this->inventories->updateQuantity($request->inv_id, (int)$current_quantity-(int)$request->w_quantity);
        return [
            'withdrawal'=> $withdrawal,
            'inventory' => $inventory
        ];
    }

    public function update(Request $request, $id){
        $withdrawal = $this->withdrawals->update($request, $id);
        $current_quantity = $this->inventories->getQuantity($request->inv_id);

        $ori_qty = $request->ori_qty;
        $edited_qty = $request->w_quantity;
        if((int)$ori_qty>(int)$edited_qty){
            $inventory = $this->inventories->updateQuantity($request->inv_id, (int)$current_quantity+((int)$ori_qty-(int)$edited_qty));
            // $update_inventory_quantity = Inventory::where('id',$request->inv_id)->update([
            //     'quantity' => (int)$current_quantity+((int)$ori_qty-(int)$edited_qty),
            // ]);
        }elseif((int)$ori_qty<(int)$edited_qty){
            $inventory = $this->inventories->updateQuantity($request->inv_id, (int)$current_quantity-((int)$edited_qty-(int)$ori_qty));
            // $update_inventory_quantity = Inventory::where('id',$request->inv_id)->update([
            //     'quantity' => (int)$current_quantity-((int)$edited_qty-(int)$ori_qty),
            // ]);
        }
        return [
            'withdrawal'=>$withdrawal
        ];
    }

    public function destroy(Withdrawal $withdrawal){
        $data = $this->withdrawals->destroy($withdrawal->id);
        // $data = Withdrawal::find($withdrawal->id);

        // $current_quantity = Inventory::where('id',$withdrawal->inventory_id)->get();
        $current_quantity = $this->inventories->getQuantity($withdrawal->inv_id);
        $inventory = $this->inventories->updateQuantity($request->inv_id, (int)$withdrawal->w_quantity+(int)$current_quantity);
        // Inventory::where('id',$withdrawal->inventory_id)->update([
        //     'quantity'=>(int)$withdrawal->w_quantity+(int)$current_quantity,
        // ]);
        // $data->delete();
        return [
            'resutl'=>true
        ];
    }
}