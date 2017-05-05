<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable = [
    'session_id', 'amount', 'order_id', 'method', 'verified'
  ];
}
