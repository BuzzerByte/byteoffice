<?php
namespace buzzeroffice\Http\Controllers;

use Illuminate\Http\Request;
use buzzeroffice\Http\Requests;
use buzzeroffice\Order;
use buzzeroffice\User;
use buzzeroffice\Inventory;
use buzzeroffice\Purchase;
use buzzeroffice\Client;

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
    }

    public function basic(){
        return redirect()->action('DashboardController@index');
    }
}
