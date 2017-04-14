<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
  public $timestamps = false;

  protected $fillable = [
    'title', 'price', 'high_capacity'
  ];

  public function orders()
  {
    return $this->hasMany('App\Order');
  }
}
