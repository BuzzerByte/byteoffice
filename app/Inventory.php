<?php

namespace buzzeroffice;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'model_no',
        'in_house',
        'image',
        's_price',
        's_information',
        'p_price',
        'p_information',
        'quantity',
        'type',
        'category_id',
        'tax_id',
    ];

    public function purchases(){
        return $this->hasMany('buzzeroffice\Purchase');
    }

    public function orders(){
        return $this->hasMany('buzzeroffice\Order');
    }

    public function category($id){
        $categoryId = Inventory::where('id',$id)->first()->category_id;
        return Category::where('id',$categoryId)->first()->name;
    }
}
