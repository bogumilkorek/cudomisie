<?php
$factory->define(App\Payment::class, function (Faker\Generator $faker) {

  $error = 1;
  $verified = $faker->randomElement([NULL, 1]);
  if($verified)
    $error = NULL;

  return [
    'session_id' => uniqid(),
    'order_uuid' => function () {
      return App\Order::where('payment_method_id', 1)->inRandomOrder()->first()->uuid;
    },
    'amount' => rand(100, 10000),
    'verified' => $verified,
    'error' => $error
  ];
});
