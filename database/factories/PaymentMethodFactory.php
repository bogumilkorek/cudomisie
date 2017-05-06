<?php
$factory->define(App\PaymentMethod::class, function (Faker\Generator $faker) {

  return [
    'title' => $faker->sentence(2),
  ];
});
