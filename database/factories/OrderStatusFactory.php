<?php
$factory->define(App\OrderStatus::class, function (Faker\Generator $faker) {

  return [
    'name' => $faker->sentence(5),
  ];
});
