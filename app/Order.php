<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'name', 'email', 'phone', 'address', 'comments'
  ];

  public function products()
  {
    return $this->belongsToMany('App\Product')
    ->withPivot('product_title', 'product_quantity', 'product_price');
  }

  public function orderStatus()
  {
    return $this->belongsTo('App\OrderStatus');
  }

  public function shippingMethod()
  {
    return $this->belongsTo('App\ShippingMethod');
  }

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
