<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['College_ID','Category_Name','Status'];

    public function subjects()
    {
        return $this->hasMany('App\Subject');
    }
}
