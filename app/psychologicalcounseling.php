<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class psychologicalcounseling extends Model
{
    protected $fillable = ['name_ar','name_en','description_ar','description_en','price','image'];
    public function sectiona_ticket() {
        return $this->hasMany('App\sectiona_ticket');
    }
}
