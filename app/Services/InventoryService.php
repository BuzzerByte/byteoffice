<?php

namespace App\Services;

use App\Repositories\Interfaces\IInventoryRepository;
use Illuminate\Http\Request;
use App\Inventory;

class InventoryService{
    protected $inventories;

    public function __construct(IInventoryRepository $inventories){
        $this->inventories = $inventories;
    }

    public function all(){
        return $this->inventories->all();
    }
}