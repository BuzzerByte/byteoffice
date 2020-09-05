<?php

namespace App\Services;

use App\Repositories\Interfaces\IInventoryRepository;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\ITaxRepository;
use Illuminate\Http\Request;
use App\Inventory;

class InventoryService{
    protected $inventories;
    protected $categories;
    protected $taxes;

    public function __construct(
        IInventoryRepository $inventories,
        ICategoryRepository $categories,
        ITaxRepository $taxes
    ){
        $this->inventories = $inventories;
        $this->categories = $categories;
        $this->taxes = $taxes;
    }

    public function all(){
        // $inventories = Inventory::all();
        // $categories = Category::all();
        // $taxes = Tax::all();
        $inventories = $this->inventories->all();
        $categories = $this->categories->all();
        $taxes = $this->taxes->all();

        return [
            'inventories'=>$inventories,
            'categories'=>$categories,
            'taxes'=>$taxes
        ];
    }
}