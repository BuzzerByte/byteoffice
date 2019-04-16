<?php

namespace buzzeroffice;

use Illuminate\Database\Eloquent\Model;
use buzzeroffice\Vendor;

class Purchase extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id',
        'b_reference',
        'status',
        'note',
        'total',
        'discount',
        'tax',
        'transport',
        'g_total',
        'paid',
        'balance',
        'created_at',
        'updated_at',
    ];

    public function product(){
        return $this->belongsTo('buzzeroffice\Inventory');
    }

    public function timeFormat($dateTime){
        return Carbon::parse($dateTime)->format('d M Y');
    }

    public function vendor($id){
        $vendorId = Quotation::where('id',$id)->first()->client_id;
        return Vendor::where('id',$vendorId)->first()->name;
    }
}
