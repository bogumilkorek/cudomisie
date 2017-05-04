<?php

namespace App\Console\Commands;
use App\Image;
use Illuminate\Support\Facades\File;

use Illuminate\Console\Command;

class ClearImages extends Command
{
  /**
  * The name and signature of the console command.
  *
  * @var string
  */
  protected $signature = 'image:clear';

  /**
  * The console command description.
  *
  * @var string
  */
  protected $description = 'Clean "orphaned" images (daily).
  As dropzone works asynchronously there might be situations where admin
  ads images without saving rest of the content. This command handles it.';

  /**
  * Create a new command instance.
  *
  * @return void
  */
  public function __construct()
  {
    parent::__construct();
  }

  /**
  * Execute the console command.
  *
  * @return mixed
  */
  public function handle()
  {
    $images = Image::where('imageable_id', 0)->get();

    foreach($images as $image)
    {
      if(File::exists(public_path('/photos/upload/' . $image->url)))
        File::delete(public_path('/photos/upload/' . $image->url));
      if(File::exists(public_path('/photos/upload/thumbs/' . $image->url)))
        File::delete(public_path('/photos/upload/thumbs/' . $image->url));

      $image->delete();

    }

    echo "Images cleared successfully.";
  }
}
