<?php

$factory->define(App\Image::class, function (Faker\Generator $faker) {
  $imageable_type = $faker->randomElement(['Page', 'Product']);

  return [
    'imageable_id' => function ($imageable_type) {
      if($imageable_type == 'page')
      return App\Page::select('id')->orderByRaw("RAND()")->first()->id;
      else
      return App\Product::select('id')->orderByRaw("RAND()")->first()->id;
    },
    'imageable_type' => $imageable_type,
    'url' => $faker->imageUrl(1280, 800)
  ];
});
