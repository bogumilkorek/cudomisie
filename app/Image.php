<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  public $timestamps = false;

  protected $thumbnail_url;

  protected $fillable = [
    'url', 'original_url', 'size', 'imageable_id', 'imageable_type', 'form_token'
  ];

  public function imageable()
  {
    return $this->morphTo();
  }

  public function getUrlAttribute($url)
  {
    return asset('/photos/upload/' . $url);
  }

  public function getThumbnailUrlAttribute()
  {
    return asset(str_replace('/upload/', '/upload/thumbs/', $this->url));
  }

}
