<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class diet extends Model
{

    public $fillable = ['user_id','have'];

    public function User() {
    	return $this->belongsTo('App\User');
    }
}
