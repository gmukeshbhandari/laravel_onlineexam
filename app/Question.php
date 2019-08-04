<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable =['College_ID','Subject_ID','Question','Option1','Option2','Option3','Option4','Correct_Answer','Marks'];

    public function subject()
    {
        return $this->belongsTo('App\Subject','Subject_ID');
    }
}
