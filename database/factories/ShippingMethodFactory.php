<?php
$factory->define(App\ShippingMethod::class, function (Faker\Generator $faker) {

  return [
    'title' => $faker->sentence(2),
    'price' => $faker->randomFloat(2, 10, 25) . ' ' . __('$'),
  ];
});
