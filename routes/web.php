<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth
Auth::routes();

// Admin
Route::group(['prefix' => __('admin')], function () {
  Route::resource('blogPosts', 'BlogPostController');
  Route::resource('products', 'ProductController');
  Route::resource('categories', 'CategoryController');
  Route::resource('orders', 'OrderController');
  Route::resource('orderStatuses', 'OrderStatusController');
  Route::resource('shippingMethods', 'ShippingMethodController');
  Route::resource('pages', 'PageController');
  Route::post('images/store', 'ImageController@store')->name('images.store');
  Route::delete('images/destroy', 'ImageController@destroy')->name('images.destroy');
  Route::get('/', 'PageController@index')->name('dashboard');
});

// Shopping cart
Route::get(__('cart'), 'CartController@show')->name('cart.show');
Route::post('cart/addItem', 'CartController@addItem')->name('cart.add');
Route::put('cart/updateItem', 'CartController@updateItem')->name('cart.update');
Route::delete('cart/removeItem', 'CartController@removeItem')->name('cart.remove');
Route::delete('cart/clear', 'CartController@clear')->name('cart.clear');

// Contact form
Route::post('email/contact', 'EmailController@contactForm')->name('email.contactForm');

// User
Route::get(__('offer') . '/{category}', 'CategoryController@show')->name('user.categories.show');
Route::get(__('offer') . '/{category}/{product}', 'ProductController@show')->name('user.products.show');
Route::get(__('offer'), 'ProductController@indexUser')->name('user.products.index');
Route::get(__('blog') . '/{blogPost}', 'BlogPostController@show')->name('user.blogPosts.show');
Route::get(__('blog'), 'BlogPostController@indexUser')->name('user.blogPosts.index');
Route::get(__('place-order'), 'OrderController@createUser')->name('user.orders.create');
Route::get(__('search'), 'SearchController@search')->name('user.search');
Route::get('{page}', 'PageController@show')->name('user.pages.show');
Route::get('/', 'PageController@showHomepage')->name('user.homepage.show');
