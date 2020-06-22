<?php

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Order;
use App\User;
use App\Inventory;
use App\Purchase;
use App\Client;
namespace App\Http\Controllers;


class DashboardController extends Controller
{
    public function index()
    {
        $users = User::All();
        $totalUser = $users->count();

        $orders = Order::All();
        $totalOrder = $orders->count();

        $products = Inventory::All();
        $totalProduct = $products->count();

        $purchases = Purchase::All();
        $totalPurchase = $purchases->count();

        $clients = Client::All();
        $allOrders = Order::All();
        
        return view('admin.dashboard.basic',['orders'=>$totalOrder,'users'=>$totalUser,'products'=>$totalProduct,'purchases'=>$totalPurchase,'clients'=>$clients,'AllOrder'=> $allOrders]);

        //return view('admin.dashboard.basic');
    }
}
