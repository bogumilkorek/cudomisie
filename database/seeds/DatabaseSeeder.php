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
    // Manualy instert admin (first user)
    factory(App\User::class)->create(
      [
        'name' => 'Your beloved admin',
        'email' => 'admin@cudomisie.app',
        'password' => bcrypt('secret'),
        'phone' => 'restricted',
        'address' => 'restricted',
      ]
    );

    // Image creates also Pages and Products
  //  factory(App\Image::class, 50)->create();
  factory(App\Page::class, 9)->create();
    factory(App\Product::class, 9)->create();
    factory(App\User::class, 9)->create();
    factory(App\BlogPost::class, 30)->create();
    factory(App\Category::class, 10)->create();
    factory(App\ShippingMethod::class, 5)->create();
    factory(App\OrderStatus::class, 5)->create();
    factory(App\Order::class, 20)->create();

    // Fill pivot tables, I'm doing it this way
    // to prevent creating models for pivot tables
    for($i = 0; $i < App\Product::all()->count(); $i++)
    {
      $category_id = App\Category::select('id')->orderByRaw("RAND()")->first()->id;
      $product_id = $i;

      DB::table('category_product')->insert(
        [
          'category_id' => $category_id,
          'product_id' => $product_id,
        ]
      );
    }

    for($i = 0; $i < 10; $i++)
    {
      $order_id = App\Order::select('id')->orderByRaw("RAND()")->first()->id;
      $product_id = App\Product::select('id')->orderByRaw("RAND()")->first()->id;
      $product_name = App\Product::find($product_id)->name;
      $product_price = App\Product::find($product_id)->price;
      $product_quantity = rand(1, 9);

      DB::table('order_product')->insert(
        [
          'order_id' => $order_id,
          'product_id' => $product_id,
          'product_name' => $product_name,
          'product_price' => $product_price,
          'product_quantity' => $product_quantity,
        ]
      );
    }
  }
}
