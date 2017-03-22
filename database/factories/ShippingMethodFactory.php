<?php
$factory->define(App\ShippingMethod::class, function (Faker\Generator $faker) {

  return [
    'name' => $faker->sentence(5),
    'price' => $faker->randomFloat(2, 10, 25),
    'cash_on_delivery' => $faker->randomFloat(2, 15, 30),
  ];
});
