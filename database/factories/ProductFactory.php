<?php
$factory->define(App\Product::class, function (Faker\Generator $faker) {

  return [
    'title' => $faker->sentence(5),
    'description' => $faker->paragraph(5),
    'price' => $faker->randomFloat(2, 50, 200),
    'dimensions' => $faker->randomNumber(2) . 'x' . $faker->randomNumber(2) . ' cm',
  ];
});
