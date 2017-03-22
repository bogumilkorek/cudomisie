<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
  public $timestamps = false;

  protected $fillable = [
    'name', 'price', 'cash_on_delivery'
  ];

  public function orders()
  {
    return $this->hasMany('App\Order');
  }
}
