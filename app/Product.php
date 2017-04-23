<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Product extends Model
{

  use SoftDeletes;

  protected $price_tax, $post_tax_price;

  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'title', 'description', 'price', 'dimensions'
  ];

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function categories()
  {
    return $this->belongsToMany('App\Category');
  }

  public function orders()
  {
    return $this->belongsToMany('App\Order');
  }

  public function images()
  {
    return $this->morphMany('App\Image', 'imageable');
  }

  public function shippingMethods()
  {
    return $this->belongsToMany('App\ShippingMethod');
  }

  public function getCreatedAtAttribute($date)
  {
    $currentDate = new Carbon($date);
    return Carbon::createFromFormat('Y-m-d H:i:s', $currentDate)->format('d.m.Y, H:i');
  }

  public function getPriceTaxAttribute()
  {
    return number_format((floatval($this->price) * 0.23) / 1.23, 2) . ' ' . __('$');
  }

  public function getPostTaxPriceAttribute()
  {
    return number_format((floatval($this->price) - floatval($this->getPriceTaxAttribute())), 2) . ' ' . __('$');
  }

}
