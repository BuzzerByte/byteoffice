<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
use Carbon\Carbon;
use App\Order;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'invoice_date',
        'due_date',
        'total',
        'g_total',
        'tax',
        'discount',
        'receive_amt',
        'amt_due',
        'status',
        'order_note',
        'order_activities',
    ];

    public function product(){
        return $this->belongsTo('App\Inventory');
    }

    public function timeFormat($dateTime){
        return Carbon::parse($dateTime)->format('d M Y');
    }

    public function orderClient($id){
        return Client::select('name')->where('id',Order::select('client_id')->where('id',$id)->first()->client_id)->first()->name;
    }
}
