<?php
$factory->define(App\Payment::class, function (Faker\Generator $faker) {

  $error = 1;
  $verified = rand(0, 1);
  if($verified)
    $error = 0;

  return [
    'session_id' => function () {
      return App\Order::where('payment_method_id', 1)->inRandomOrder()->first()->uuid;
    },
    'amount' => rand(100, 10000),
    'verified' => $verified,
    'error' => $error
  ];
});
