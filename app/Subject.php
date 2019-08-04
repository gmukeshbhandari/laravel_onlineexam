<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['College_ID','Subject_Name','Category_ID','Duration','Status','Date_of_Exam'];

    public function category()
    {
        return $this->belongsTo('App\Category','Category_ID'); /* Category_ID is unique key of Subject Model (subjects table).
 This means Through Subject Model(subject table), we can access the columns,rows and values of category model(categories table) [Subject Model ko Category_ID le Category Model ko id sanga compare garcha */
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }
}
