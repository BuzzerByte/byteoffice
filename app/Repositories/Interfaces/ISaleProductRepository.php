<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\SaleProduct;

interface ISaleProductRepository
{
    public function storeByOrder($inventories, $order_id);
    public function getByOrder($order_id);
    public function updateByOrder($inventories, $order_id);
}