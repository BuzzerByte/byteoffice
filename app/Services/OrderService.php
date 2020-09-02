<?php

namespace App\Services;

use App\Repositories\Interfaces\IOrderRepository;
use App\Repositories\Interfaces\ISaleProductRepository;
use App\Repositories\Interfaces\IClientRepository;
use App\Repositories\Interfaces\IPaymentRepository;
use Illuminate\Http\Request;
use App\Order;
use App\SaleProduct;

class OrderService {
    protected $orders;
    protected $saleProducts;
    protected $clients;
    protected $payments;

    public function __construct(
        IOrderRepository $orders, 
        ISaleProductRepository $saleProducts, 
        IClientRepository $clients, 
        IPaymentRepository $payments
    ){
        $this->orders = $orders;
        $this->saleProducts = $saleProducts;
        $this->clients = $clients;
        $this->payments = $payments;
    }

    public function all(){
        return $this->orders->all();
    }

    public function store(Request $request, $inventories){
        $order =  $this->orders->store($request);
        return $this->saleProducts->storeByOrder($inventories, $order['id']);
    }

    public function show(Order $order){
        $invoice = $this->orders->show($order);
        $sale_product = $this->saleProducts->getByOrder($invoice->id);
        $client = $this->clients->getByOrder($invoice->id);
        $payments = $this->payments->getByOrder($invoice->id);
        return ['invoice'=>$invoice, 'sale_product'=>$sale_product, 'client'=>$client,'payments'=>$payments];
    }

    public function edit(Order $order){
        return $this->orders->edit($order);
    }

    public function update(Request $request, Order $order){
        return $this->orders->update($request, $order);
    }

    public function destroy(Order $order){
        return $this->orders->destroy($order);
    }
}