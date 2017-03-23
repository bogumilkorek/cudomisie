<?php
$factory->define(App\OrderStatus::class, function (Faker\Generator $faker) {

  return [
    'title' => $faker->sentence(5),
  ];
});
