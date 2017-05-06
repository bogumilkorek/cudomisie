<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable = [
    'session_id', 'amount', 'order_id', 'method', 'verified'
  ];

  public function order()
  {
    return $this->belongsTo('App\Order', 'session_id', 'uuid');
  }
}
