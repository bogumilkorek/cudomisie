<?php
$factory->define(App\Product::class, function (Faker\Generator $faker) {

  return [
    'title' => $faker->sentence(5),
    'description' => $faker->paragraph(5),
    'price' =>  number_format($faker->randomFloat(2, 50, 90), 2) . ' ' . __('$'),
    'dimensions' => $faker->randomNumber(2) . 'x' . $faker->randomNumber(2) . ' ' . __('cm'),
  ];
});
