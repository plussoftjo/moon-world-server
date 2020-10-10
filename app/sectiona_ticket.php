<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sectiona_ticket extends Model
{
    public $with =['psychologicalcounseling'];
    protected $fillable = ['user_id','psychologicalcounseling_id','price','state'];

    public function User() {
    	return $this->belongsTo('App\User');
    }

    public function psychologicalcounseling() {
    	return $this->belongsTo('App\psychologicalcounseling');
    }

   
}
