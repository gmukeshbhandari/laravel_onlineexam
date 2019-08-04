<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['email','Subject_ID','Subject_Name','Category_Name','Exam_Date','Result','Full_Marks','Pass_Marks','Obtained_Marks','No_of_Correct_Answer','No_of_Incorrect_Answer','No_of_Leaved_Answer'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
