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
      __('Shipping'),
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
    ]);
  }

  public function insertAdmin($email, $password)
  {
    factory(App\User::class)->create([
        'name' => 'Your beloved admin',
        'email' => $email,
        'password' => bcrypt($password),
        'phone' => 'restricted',
        'address' => 'restricted',
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
}
