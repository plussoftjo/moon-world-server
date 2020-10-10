<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{

    public $with = ['course_epsoide'];
    protected $fillable = ['name_ar','name_en','description_ar','description_en','image','price'];
    

    public function course_epsoide() {
        return $this->hasMany('App\course_epsoide');
    }
}
