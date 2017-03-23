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
    $this->createSlugs();

    // Get latest products and share it to all views
    $this->getLatestProducts();
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
    }
  }

  public function createSlugs() {
    Page::creating(function($page) {
      $page->slug = str_slug($page->title, '-');
      return true;
    });

    Page::updating(function($page) {
      $page->slug = str_slug($page->title, '-');
      return true;
    });

    Product::creating(function($product) {
      $product->slug = str_slug($product->title, '-');
      return true;
    });

    Product::updating(function($product) {
      $product->slug = str_slug($product->title, '-');
      return true;
    });

    Category::creating(function($category) {
      $category->slug = str_slug($category->title, '-');
      return true;
    });

    Category::updating(function($category) {
      $category->slug = str_slug($category->title, '-');
      return true;
    });

    BlogPost::creating(function($blogPost) {
      $blogPost->slug = str_slug($blogPost->title, '-');
      return true;
    });

    BlogPost::updating(function($blogPost) {
      $blogPost->slug = str_slug($blogPost->title, '-');
      return true;
    });


    // foreach($modelNames as $modelName)
    // {
    //   $model = app("App\\$modelName");
    //
    //   $model::creating(function($instance) {
    //     $instance->slug = str_slug($instance->title, '-');
    //     return true;
    //   });
    //
    //   $model::updating(function($instance) {
    //     $instance->slug = str_slug($instance->title, '-');
    //     return true;
    //   });
    //
    // }
  }
}
