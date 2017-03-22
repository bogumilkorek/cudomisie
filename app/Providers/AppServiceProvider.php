<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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

    // Get latest products and share it to all views
    $this->getLatestProducts();

    // Create slug before adding and updating page, product, category and blog post
    $this->createSlugs();
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
      // Get 6 latest products
      $latestProducts = Product::latest()
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
      $product->slug = str_slug($product->name, '-');
      return true;
    });

    Product::updating(function($product) {
      $product->slug = str_slug($product->name, '-');
      return true;
    });

    Category::creating(function($category) {
      $category->slug = str_slug($category->name, '-');
      return true;
    });

    Category::updating(function($category) {
      $category->slug = str_slug($category->name, '-');
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
  }
}
