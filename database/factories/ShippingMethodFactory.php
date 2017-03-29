<?php
$factory->define(App\ShippingMethod::class, function (Faker\Generator $faker) {

  return [
    'title' => $faker->sentence(2),
    'price' => $faker->randomFloat(2, 10, 25) . ' ' . __('$'),
    'cash_on_delivery' => $faker->randomFloat(2, 15, 30) . ' ' . __('$'),
  ];
});
