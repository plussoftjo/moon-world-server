<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shop_order_address extends Model
{
    protected $fillable = ['name','address','phone','email'];
    
}
