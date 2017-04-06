<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
  public $timestamps = false;

  public function imageable()
  {
    return $this->morphTo();
  }

  protected $fillable = [
    'url', 'imageable_id', 'imageable_type'
  ];
}
