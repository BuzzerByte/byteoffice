<?php

namespace App\Repositories\Eloquents;

use App\Payment;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Response;
use File;
use Session;
use Excel;
use DB;
use App\Repositories\Interfaces\IPaymentRepository;

class PaymentRepository implements IPaymentRepository
{
    protected $payments;

    public function __construct(Payment $payments){
        $this->payments = $payments;
    }
   
    /**
     * Get all of the order for the given user.
     *
     * @param  Order  $order
     * @return Collection
     */
    public function all()
    {
        return $this->payments->get();
    }

    public function getByOrder($order_id){
        return $this->payments->where('order_id',$order_id)->get();
    }
}