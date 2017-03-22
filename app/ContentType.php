<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
  public $timestamps = false;

  protected $fillable = [
    'name',
  ];
  
  public function page()
  {
    return $this->hasMany('App\Page');
  }
}
