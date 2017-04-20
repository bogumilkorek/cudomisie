<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

  use SoftDeletes;

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
}
