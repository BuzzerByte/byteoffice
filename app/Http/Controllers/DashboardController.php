<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Inventory;
use App\Purchase;
use App\Client;
use App\Http\Requests;
use App\Order;
use App\User;

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
       
        return redirect()->route('admin.dashboard.basic',
            [   "orders"=> $totalOrder,
                "users"=> $totalUser,
                "products"=> $totalProduct,
                "purchases"=> $totalPurchase,
                "clients"=>$clients,
                "AllOrder"=> $allOrders
            ]);
    }

    public function basic() 
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
       
         return view('admin.dashboard.basic',
         [   
             "orders"=> $totalOrder,
             "users"=> $totalUser,
             "products"=> $totalProduct,
             "purchases"=> $totalPurchase,
             "clients"=>$clients,
             "AllOrder"=> $allOrders
         ]);
    }

    public function ecommerce() 
    {
        return view('admin.dashboard.ecommerce');
    }

    public function finance() 
    {
        return view('admin.dashboard.finance');
    }
}
