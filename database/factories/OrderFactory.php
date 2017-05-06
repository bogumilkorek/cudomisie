<?php

$factory->define(App\Order::class, function (Faker\Generator $faker) {

  return [
    'user_id' => function () {
      return App\User::inRandomOrder()->first()->id;
    },
    'order_status_id' => function () {
      return App\OrderStatus::inRandomOrder()->first()->id;
    },
    'payment_method_id' => function () {
      return App\PaymentMethod::inRandomOrder()->first()->id;
    },
    'shipping_method_name' => function () {
      return App\ShippingMethod::inRandomOrder()->first()->title;
    },
    'shipping_cost' => $faker->randomFloat(2, 50, 200) . ' ' . __('$'),
    'total_cost' => $faker->randomFloat(2, 250, 350) . ' ' . __('$'),
    'name' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'phone_number' => $faker->phoneNumber,
    'address' => $faker->address,
    'comments' => $faker->randomElement([NULL, $faker->text]),
    'invoice_url' => 'mock.pdf'
  ];
});
