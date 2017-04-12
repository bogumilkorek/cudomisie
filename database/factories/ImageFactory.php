<?php

$factory->define(App\Image::class, function (Faker\Generator $faker) {
  $imageable_type = $faker->randomElement(['pages', 'products', 'blogPosts']);

  return [
    'imageable_id' => function () use($imageable_type) {
      if($imageable_type == 'products')
        return factory(App\Product::class)->create()->id;
      else if($imageable_type == 'blogPosts')
          return factory(App\BlogPost::class)->create()->id;
      else
        return factory(App\Page::class)->create()->id;
    },
    'imageable_type' => $imageable_type,
    'url' => 'mock-' . rand(1,3) . '.jpg',
    'original_url' => 'mock-' . rand(1,3) . '.jpg',
    'size' => 123456,
  ];
});
