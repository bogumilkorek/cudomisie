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
    'uuid', 'name', 'email', 'phone', 'address', 'comments', 'invoice_url'
  ];

  public function products()
  {
    return $this->belongsToMany('App\Product')
    ->withTrashed()
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
    $currentDate = new Carbon($date);
    return Carbon::createFromFormat('Y-m-d H:i:s', $currentDate)->format('d.m.Y, H:i');
  }
}
