<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Payment;

interface IPaymentRepository
{
    public function all();
    public function getByOrder($order_id);
}