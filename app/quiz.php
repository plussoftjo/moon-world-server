<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    public $with = ['quiz_question'];
    protected $fillable = ['name_ar','name_en','description_ar','description_en','image','price'];

    public function quiz_question() {
        return $this->hasMany('App\quiz_question');
    }
}
