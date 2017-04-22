<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{

  public $timestamps = false;

  protected $fillable = [
    'title', 'price', 'high_capacity', 'cash_on_delivery'
  ];

  public function orders()
  {
    return $this->hasMany('App\Order', 'shipping_method_name', 'title');
  }

  public function products()
  {
    return $this->belongsToMany('App\Products');
  }
}
