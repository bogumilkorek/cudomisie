<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel
{
  /**
  * The Artisan commands provided by your application.
  *
  * @var array
  */
  protected $commands = [
    //
  ];

  /**
  * Define the application's command schedule.
  *
  * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
  * @return void
  */
  protected function schedule(Schedule $schedule)
  {

  //   // Clean orphaned images daily
  //   $schedule->call(function () {
  //     DB::table('images')->where('imageable_id', 0)->delete();
  //   })->everyMinute();
   // 
  //   // Send queued e-mails
  //  $schedule->command('queue:work')->cron('* * * * * *');
  }

  /**
  * Register the Closure based commands for the application.
  *
  * @return void
  */
  protected function commands()
  {
    require base_path('routes/console.php');
  }
}
