<?php

namespace App\Repositories\Eloquents;

use App\Order;
use App\Client;
use App\User;
use Illuminate\Http\Request;
use Response;
use File;
use Session;
use Excel;
use DB;
use App\Repositories\Interfaces\IOrderRepository;
use Auth;

class OrderRepository implements IOrderRepository
{
    protected $orders;
    protected $auth_user;
    protected $clients;

    public function __construct(Order $orders, User $auth_user, Client $clients){
        $this->orders = $orders;
        $this->auth_user = $auth_user;
        $this->clients = $clients;
    }
   
    /**
     * Get all of the order for the given user.
     *
     * @param  Order  $order
     * @return Collection
     */
    public function all()
    {
        return $this->orders
                    ->leftjoin('clients','orders.client_id','clients.id')
                    ->where('clients.user_id',Auth::user()->id)
                    ->addSelect(['client'=> $this->clients->select('name')->whereColumn('id','orders.client_id')])
                    ->orderBy('orders.created_at', 'asc')
                    ->get();
    }

    public function store(Request $request){
        $order = new Order;
        $order->client_id = $request->client_id;
        $order->invoice_date = $request->invoice_date;
        $order->due_date = $request->due_date;
        $order->total = $request->total;
        $order->g_total = $request->g_total;
        $order->tax = $request->tax;
        $order->discount = $request->discount;
        $order->receive_amt = 0;
        $order->amt_due = 0;
        $order->paid = 0;
        $order->balance = 0;
        $order->status = 'processing_order';
        $order->order_note = $request->order_note;
        $order->order_activities = $request->order_activities;
        return ['result'=>$order->save(),'id'=>$order->id];
    }

    public function show(Order $order){
        // $order = $this->orders->addSelect(['client'=>$this->clients->select('name')->whereColumn('id','orders.client_id')])->get();
        return $order;
    }

    public function edit(Order $order){
        return $order;
    }

    public function update(Client $client, Request $request){
        $client = Client::find($client->id);
        $client->name = $request->name;
        $client->company = $request->company_name;
        $client->phone = $request->phone;
        $client->fax = $request->fax;
        $client->email = $request->email;
        $client->website = $request->website;
        $client->billing_address = $request->b_address;
        $client->shipping_address = $request->s_address;
        $client->note = $request->note;
        return $client->save();
    }

    public function destroy(Client $client){
        $client = Client::find($client->id);
        return $client->delete();
    }
}