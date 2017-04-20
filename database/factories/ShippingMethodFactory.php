<?php
$factory->define(App\ShippingMethod::class, function (Faker\Generator $faker) {

  return [
    'title' => $faker->sentence(2),
    'price' => number_format($faker->randomFloat(2, 10, 25), 2) . ' ' . __('$'),
    'high_capacity' => rand(0, 1),
    'cash_on_delivery' => rand(0, 1),
  ];
});
