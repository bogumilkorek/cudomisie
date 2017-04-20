<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use SoftDeletes;

  /**
  * The attributes that should be mutated to dates.
  *
  * @var array
  */
  protected $dates = ['deleted_at'];

  protected $fillable = [
    'title', 'parent_id'
  ];

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function products()
  {
    return $this->belongsToMany('App\Product');
  }

  // Subcategories
  public function parent()
  {
    return $this->belongsTo(self::class, 'parent_id');
  }

  public function children()
  {
    return $this->hasMany(self::class, 'parent_id');
  }
}
