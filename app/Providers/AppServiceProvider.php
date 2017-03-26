<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Relations\Relation;
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


    Relation::morphMap([
      'products' => 'App\Product',
      'pages' => 'App\Page',
    ]);


    // Create slug before adding and updating page, product, category and blog post
    $this->createSlugs(['Page', 'Product', 'Category', 'BlogPost']);

    // Get latest products and share it to all views
    $this->getLatestProducts();

    // Get categories and share it to all views (for nav)
    $this->getCategories();
  }

  /**
  * Register any application services.
  *
  * @return void
  */
  public function register()
  {
    //
  }

  public function getLatestProducts() {
    // Allow migrations to work
    if(!app()->runningInConsole()) {
      // Get 6 latest active products
      $latestProducts = Product::where('hidden', NULL)
      ->orderBy('id', 'desc')
      ->with('categories')
      ->with('images')
      ->take(6)
      ->get();

      View::share('latestProducts', $latestProducts);
      // View::composer('*', function($view) {
      //   $view->with('latestProducts', $latestProducts);
      // });
    }
  }

  public function getCategories() {
    // Allow migrations to work
    if(!app()->runningInConsole()) {
      $categories = Category::orderBy('title', 'asc')
      ->get();

      View::share('categories', $categories);
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
