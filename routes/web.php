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

// Socialite
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// Admin
Route::group(['prefix' => __('admin')], function () {
  Route::resource('blogPosts', 'BlogPostController');
  Route::resource('products', 'ProductController');
  Route::put('products/{slug}/restore', 'ProductController@restore')->name('products.restore');
  Route::resource('categories', 'CategoryController');
  Route::put('categories/{slug}/restore', 'CategoryController@restore')->name('categories.restore');
  Route::resource('orders', 'OrderController');
  Route::post('orders/{order}/updateStatus', 'OrderController@updateStatus');
  Route::resource('orderStatuses', 'OrderStatusController');
  Route::resource('shippingMethods', 'ShippingMethodController');
  Route::resource('pages', 'PageController');
  Route::post('images/store', 'ImageController@store')->name('images.store');
  Route::post('images/destroy', 'ImageController@destroy')->name('images.destroy');
  Route::get('/', 'PageController@index')->name('dashboard');
});

// Shopping cart
Route::get(__('cart'), 'CartController@show')->name('cart.show');
Route::post('cart/addItem', 'CartController@addItem')->name('cart.add');
Route::post('cart/updateItem', 'CartController@updateItem')->name('cart.update');
Route::post('cart/removeItem', 'CartController@removeItem')->name('cart.remove');
Route::post('cart/clear', 'CartController@clear')->name('cart.clear');

// Contact form
Route::post('email/contact', 'EmailController@contactForm')->name('email.contactForm');

// User
Route::get(__('invoice') . '/{invoice}', function($invoice)
{
  $file = public_path('files/invoices/' . $invoice);
  return response()->download($file);
})->name('user.orders.invoice');
Route::get(__('offer') . '/{category}', 'CategoryController@show')->name('user.categories.show');
Route::get(__('offer') . '/{category}/{subcategory?}', 'CategoryController@show')->name('user.categories.show');
Route::get(__('offer') . '/{category}/{subcategory}/{product}', 'ProductController@show')->name('user.products.show');
Route::get(__('offer'), 'ProductController@indexUser')->name('user.products.index');
Route::get(__('blog') . '/{blogPost}', 'BlogPostController@show')->name('user.blogPosts.show');
Route::get(__('blog'), 'BlogPostController@indexUser')->name('user.blogPosts.index');
Route::get(__('place-order'), 'OrderController@createUser')->name('user.orders.create');
Route::post(__('place-order'), 'OrderController@storeUser')->name('user.orders.store');
Route::get(__('orders') . '/{order}', 'OrderController@showUser')->name('user.orders.show');
Route::get(__('orders'), 'OrderController@indexUser')->name('user.orders.index');
Route::get('check-user', 'UserController@checkUser');
Route::get(__('profile'), 'UserController@showProfile')->name('user.profile.show');
Route::put(__('profile') . '/update/{user}', 'UserController@updateProfile')->name('user.profile.update');
Route::get(__('search'), 'SearchController@search')->name('user.search');
Route::get('{page}', 'PageController@show')->name('user.pages.show');
Route::get('/', 'PageController@showHomepage')->name('user.homepage.show');
