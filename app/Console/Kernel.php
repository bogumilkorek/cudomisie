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
    Commands\ClearImages::class,
  ];

  /**
  * Define the application's command schedule.
  *
  * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
  * @return void
  */
  protected function schedule(Schedule $schedule)
  {
    $path = base_path();

    // Clean orphaned images daily
    // $schedule->call(function () {
    //   DB::table('images')->where('imageable_id', 0)->delete();
    // })->daily();

    $schedule->command('php-7-cli ' . $path . '/artisan image:clear')->daily();
    
    // Monitor queue listener
    // Code from: papertank.co.uk
    $schedule->call(function() use($path) {
      if (file_exists($path . '/queue.pid')) {
        $pid = file_get_contents($path . '/queue.pid');
        $result = exec("ps -p $pid --no-heading | awk '{print $1}'");
        $run = $result == '' ? true : false;
      } else {
        $run = true;
      }
      if($run) {
        $command = 'php7-cli -c ' . $path .'/php.ini ' . $path . '/artisan queue:listen --tries=3 > /dev/null & echo $!';
        $number = exec($command);
        file_put_contents($path . '/queue.pid', $number);
      }
    })->name('monitor_queue_listener')->everyMinute();

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
