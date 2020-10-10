<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shop_category extends Model
{
    protected $fillable =['name_ar','name_en','description_ar','description_en','image'];
}
