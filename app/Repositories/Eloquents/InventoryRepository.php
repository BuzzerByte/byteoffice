<?php

namespace App\Repositories\Eloquents;

use App\Inventory;
use App\User;
use Auth;
use App\Repositories\Interfaces\IInventoryRepository;

class InventoryRepository implements IInventoryRepository
{
    protected $inventories;

    public function __construct(Inventory $inventories){
        $this->inventories = $inventories;
    }
   
    /**
     * Get all of the order for the given user.
     *
     * @param  Order  $order
     * @return Collection
     */
    public function all()
    {
        return $this->inventories
                    ->where('user_id',Auth::user()->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}