<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Relations\Relation;
use Laravel\Dusk\DuskServiceProvider;
use App\Page;
use App\Product;
use App\Category;
use App\BlogPost;

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
    ]);

    // Create slug before adding and updating page, product, category and blog post
    $this->createSlugs(['Page', 'Product', 'Category', 'BlogPost']);

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
