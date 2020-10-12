<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationProduct extends Model
{
    protected $fillable = [
        'inventory_id',
        'description',
        'quantity',
        'rate',
        'amount',
        'quotation_id'
    ];
}
