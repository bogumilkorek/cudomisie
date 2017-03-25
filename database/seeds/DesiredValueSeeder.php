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
    // Insert admin (first user)
    factory(App\User::class)->create([
        'name' => 'Your beloved admin',
        'email' => 'admin@cudomisie.app',
        'password' => bcrypt('secret'),
        'phone' => 'restricted',
        'address' => 'restricted',
      ]);

      // Insert desired pages to match navigation bar
      $desiredTitles = ['Serdecznie witamy', 'O nas',
      'Wysyłka', 'Regulamin', 'Opinie', 'Kontakt'];

      foreach($desiredTitles as $dTitle)
      {
        factory(App\Page::class)->create([
          'title' => $dTitle,
        ]);
      }
  }
}
