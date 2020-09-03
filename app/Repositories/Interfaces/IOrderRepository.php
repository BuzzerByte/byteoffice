<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Order;

interface IOrderRepository
{
    public function all();
    public function store(Request $request);
    public function show(Order $order);
    public function edit(Order $order);
    public function update(Request $request, Order $order, $paid);
    public function destroy(Order $order);
}