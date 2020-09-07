<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'reference_no',
        'date',
        'received_amt',
        'attachment',
        'payment_method',
        'cc_name',
        'cc_number',
        'cc_type',
        'cc_month',
        'cc_year',
        'cvc',
        'payment_ref',
        'purchase_id',
        'order_id'
    ];
}
