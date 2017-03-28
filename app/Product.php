<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
    'title', 'description', 'price', 'dimensions'
  ];

  protected $hidden = [
    'hidden',
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
}
