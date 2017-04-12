<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
  static $password;

  return [
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'password' => $password ?: $password = bcrypt('secret'),
    'remember_token' => str_random(10),
    'phone' => $faker->phoneNumber,
    'street' => $faker->streetName . ', ' . $faker->buildingNumber,
    'city' => $faker->postcode . ', ' . $faker->city,
  ];
});
