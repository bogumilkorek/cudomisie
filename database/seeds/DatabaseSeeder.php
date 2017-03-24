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
    // Image creates Pages and Products
    factory(App\Image::class, 50)->create();
    factory(App\User::class, 9)->create();
    factory(App\BlogPost::class, 30)->create();
    factory(App\Category::class, 10)->create();
    factory(App\ShippingMethod::class, 5)->create();
    factory(App\OrderStatus::class, 5)->create();
    factory(App\Order::class, 20)->create();

    // Seed pivot tables
    $this->call(PivotTableSeeder::class);
  }
}
