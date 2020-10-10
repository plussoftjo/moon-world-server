<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shop_order_item extends Model
{
    public $with = ['items'];
    protected $fillable = ['shop_order_id','items_id','qty'];

    public function shop_order() {
        return $this->belongsTo('App\shop_order');
    }

    public function items() {
        return $this->belongsTo('App\items');
    }
}
