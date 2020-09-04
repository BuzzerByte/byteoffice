<?php

namespace App\Repositories\Interfaces;

interface IPurchaseProductRepository{
    public function store($id, $desc, $qty, $rate, $amt, $purchase_id);
    public function getByPurchaseId($purchase_id);
}