<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  public function getRouteKeyName()
  {
    return 'slug';
  }

  protected $fillable = [
    'title',
  ];

  protected $hidden = [
    'slug',
  ];
  
  public function products()
  {
    return $this->belongsToMany('App\Product');
  }
}
