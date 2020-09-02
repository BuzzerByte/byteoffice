<?php

namespace App\Services;

use App\Repositories\Interfaces\IPaymentRepository;
use Illuminate\Http\Request;
use App\Payment;

class PaymentService {
    protected $payments;

    public function __construct(IPaymentRepository $payments){
        $this->payments = $payments;
    }

    public function all(){
        return $this->payments->all();
    }
}