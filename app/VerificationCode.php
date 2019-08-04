<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
protected $fillable = ['Verification_Code','email'];
}
