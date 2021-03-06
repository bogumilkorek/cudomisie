<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Relations\Relation;
use Laravel\Dusk\DuskServiceProvider;
use App\Page;
use App\Product;
use App\Category;
use App\BlogPost;
use Mail;
use App\Mail\QueueFailed;
use App\Order;
use Webpatser\Uuid\Uuid;
use Request;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
  /**
  * Bootstrap any application services.
  *
  * @return void
  */
  public function boot()
  {
    // Fix database error
    Schema::defaultStringLength(191);

    // Set morph map for polymorphic relation
    Relation::morphMap([
      'products' => 'App\Product',
      'pages' => 'App\Page',
      'blogPosts' => 'App\BlogPost',
    ]);

    // Loalize resource URIs
    Route::resourceVerbs([
      'create' => __('create'),
      'edit' => __('edit'),
    ]);

    // Automatically create slug before add and update page, product, category and blog post
    $this->createSlugs(['Page', 'Product', 'Category', 'BlogPost']);

    // Automatically insert uuid when creating new order
    Order::creating(function($instance) {
      $instance->uuid = Uuid::generate();
      return true;
    });

    // E-mail dev when queue failed
    Queue::failing(function (JobFailed $event) {
      Mail::to(env('DEV_MAIL_ADDRESS'))
      ->send(new QueueFailed($event));
    });
  }

  /**
  * Register any application services.
  *
  * @return void
  */
  public function register()
  {
    if ($this->app->environment('local', 'testing')) {
      $this->app->register(DuskServiceProvider::class);
    }
  }

  public function createSlugs($modelNames) {
    foreach($modelNames as $modelName)
    {
      $model = app("App\\$modelName");

      $model::creating(function($instance) {
        $instance->slug = str_slug($instance->title, '-');
        return true;
      });

      $model::updating(function($instance) {
        $instance->slug = str_slug($instance->title, '-');
        return true;
      });
    }
  }
}
