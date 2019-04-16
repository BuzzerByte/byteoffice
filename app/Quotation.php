<?php

namespace buzzeroffice;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'client_id',
        'estimate_date',
        'expiration_date',
        'total',
        'g_total',
        'status',  
        'created_at',
        'updated_at'
    ];

    public function timeFormat($dateTime){
        return Carbon::parse($dateTime)->format('d M Y');
    }

    public function client($id){
        $clientId = Quotation::where('id',$id)->first()->client_id;
        return Client::where('id',$clientId)->first()->name;
    }
}
