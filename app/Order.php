<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{

  public function getRouteKeyName()
  {
    return 'uuid';
  }

  protected $fillable = [
    'uuid'
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

  public function getCreatedAtAttribute($date)
  {
    $unformattedDate = new Carbon($date);
    return Carbon::createFromFormat('Y-m-d H:i:s', $unformattedDate)->format('d.m.Y, H:i');
  }
}
