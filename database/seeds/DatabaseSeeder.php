<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    // Insert custom desired values
    $this->call(DesiredValueSeeder::class);

    // Run model factories
    // Image creates Pages, Products and Blog posts
    factory(App\Image::class, 90)->create();
    factory(App\User::class, 9)->create();
    factory(App\ShippingMethod::class, 5)->create();
    factory(App\Order::class, 20)->create();

    // Seed pivot tables
    $this->call(PivotTableSeeder::class);
  }
}
