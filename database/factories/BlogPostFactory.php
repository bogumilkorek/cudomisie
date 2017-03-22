<?php
$factory->define(App\BlogPost::class, function (Faker\Generator $faker) {

  return [
    'title' => $faker->sentence(5),
    'content' => $faker->paragraph(5),
  ];
});
