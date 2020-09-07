<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'inventory_id',
        'w_quantity',
        'withdrawer',
        'project_id',
    ];
}
