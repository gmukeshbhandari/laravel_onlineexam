<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
protected $fillable = ['id','Name','email','token'];

    public function user()
    {
        return $this->belongsTo('App\User','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Admin','id');
    }
}
