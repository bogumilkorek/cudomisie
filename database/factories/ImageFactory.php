<?php

$factory->define(App\Image::class, function (Faker\Generator $faker) {
  $imageable_type = $faker->randomElement(['pages', 'products']);

  return [
    'imageable_id' => function () use($imageable_type) {
      if($imageable_type == 'products')
        return factory(App\Product::class)->create()->id;
      else
        return factory(App\Page::class)->create()->id;
    },
    'imageable_type' => $imageable_type,
    'url' => $faker->imageUrl(1280, 800)
  ];
});
