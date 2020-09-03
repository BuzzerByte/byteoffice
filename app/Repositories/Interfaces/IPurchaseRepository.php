<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Purchase;

interface IPurchaseRepository
{
    public function getPurchaseTotal($purchase_id);
    public function updatePaid($purchase_id,$total, $balance);
    public function getById($purchase_id);
}