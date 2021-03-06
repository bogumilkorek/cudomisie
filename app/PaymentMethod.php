<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{

  public $timestamps = false;

  protected $fillable = [
    'title',
  ];

  public function orders()
  {
    return $this->belongsToMany('App\Order');
  }
}
