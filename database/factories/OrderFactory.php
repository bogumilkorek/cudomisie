<?php

$factory->define(App\Order::class, function (Faker\Generator $faker) {

  return [
    'user_id' => function () {
      return App\User::select('id')->orderByRaw("RAND()")->first()->id;
    },
    'order_status_id' => function () {
      return App\OrderStatus::select('id')->orderByRaw("RAND()")->first()->id;
    },
    'shipping_method_id' => function () {
      return App\ShippingMethod::select('id')->orderByRaw("RAND()")->first()->id;
    },
    'shipping_cost' => $faker->randomFloat(2, 50, 200) . ' ' . __('$'),
    'total_cost' => $faker->randomFloat(2, 250, 350) . ' ' . __('$'),
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'phone' => $faker->phoneNumber,
    'address' => $faker->address,
    'comments' => $faker->randomElement([NULL, $faker->text])
  ];
});
