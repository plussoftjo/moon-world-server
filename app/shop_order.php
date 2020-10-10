<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shop_order extends Model
{
    public $with = ['shop_order_address','shop_order_item'];
    protected $fillable = ['user_id','shop_order_address_id','net','state'];

    public function shop_order_address() {
        return $this->belongsTo('App\shop_order_address');
    }

    public function User() {
        return $this->belongsTo('App\User');
    }

    public function shop_order_item() {
        return $this->hasMany('App\shop_order_item');
    }

}
