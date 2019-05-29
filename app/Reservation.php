<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{

 protected $fillable = ['user_id', 'checked_out_at','book_id','checked_in_at'];
}
