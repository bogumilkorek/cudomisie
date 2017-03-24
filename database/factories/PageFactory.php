<?php
$factory->define(App\Page::class, function (Faker\Generator $faker) {

  return [
    'title' => $faker->sentence(5),
    'content' => $faker->paragraph(20),
  ];
});
