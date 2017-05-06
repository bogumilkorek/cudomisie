<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesiredValueSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    // Insert admin (first user) e-mail and password
    $this->insertAdmin('admin@cudomisie.app', 'secret');

    // Insert desired pages to match navigation bar
    $this->insertPages([
      __('Homepage'),
      __('About us'),
      __('Shipment'),
      __('Terms of use'),
      __('Feedback'),
      __('Contact'),
    ]);

    // Insert order statuses (better readability than faker)
    $this->insertOrderStatuses([
      __('Waiting for payment'),
      __('Processing'),
      __('Package sent'),
      __('Completed'),
      __('Canceled'),
      // __('Payment verification'),
      // __('Payment verified'),
      // __('Payment cancelled'),
    ]);

    // Insert payment methods (better readability than faker)
    $this->insertPaymentMethods([
      __('Online payment'),
      __('Bank transfer'),
      __('Cash on delivery')
    ]);

  // Insert custom categories and subcategories structure
  $this->insertCategories();

}

  public function insertAdmin($email, $password)
  {
    factory(App\User::class)->create([
        'admin' => true,
        'name' => 'Your beloved admin',
        'email' => $email,
        'password' => bcrypt($password),
        'phone_number' => 'restricted',
        'street' => 'restricted',
        'city' => 'restricted',
      ]);
  }

  public function insertPages($data) {

    foreach($data as $title)
    {
      factory(App\Page::class)->create([
        'title' => $title,
      ]);
    }
  }

  public function insertOrderStatuses($data) {

    foreach($data as $title)
    {
      factory(App\OrderStatus::class)->create([
        'title' => $title,
      ]);
    }
  }

  public function insertPaymentMethods($data) {

    foreach($data as $title)
    {
      factory(App\PaymentMethod::class)->create([
        'title' => $title,
      ]);
    }
  }

  public function insertCategories() {

    for($i = 1; $i <= 4; $i++)
      factory(App\Category::class)->create();

    for($i = 1; $i <= 4; $i++)
      for($j = 1; $j <= 3; $j++)
        factory(App\Category::class)->create([
          'parent_id' => $j
        ]);
  }

}
