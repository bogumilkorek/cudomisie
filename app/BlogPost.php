<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BlogPost extends Model
{
  protected $fillable = [
    'title', 'content'
  ];

  public function getRouteKeyName()
  {
    return 'slug';
  }

  public function images()
  {
    return $this->morphMany('App\Image', 'imageable');
  }

  public function getCreatedAtAttribute($date)
  {
    $currentDate = new Carbon($date);
    return Carbon::createFromFormat('Y-m-d H:i:s', $currentDate)->format('d.m.Y, H:i');
  }
}
