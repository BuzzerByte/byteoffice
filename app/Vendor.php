<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'company',
        'phone',
        'open_balance',
        'fax',
        'email',
        'website',
        'billing_address',
        'note',
        'user_id',
        'created_at',
        'updated_at',
    ];


    public function purchase(){
        return $this->hasMany('App\Purchase');
    }
}
