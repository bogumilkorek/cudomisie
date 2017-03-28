<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth')->except(['index', 'show']);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
         $products = Product::where('hidden', NULL)
         ->orderBy('id', 'desc')
         ->with('categories')
         ->with('images')
         ->get();

         return view('products.index')->withProducts($products);
     }

       /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
       public function create()
       {
         return view('products.create');
       }

       /**
       * Store a newly created resource in storage.
       *
       * @param  \App\Http\Requests\ProductRequest  $request
       * @return \Illuminate\Http\Response
       */
       public function store(ProductRequest $request)
       {
         Product::create($request->all());
         alert()->success( __('Product created!'), __('Success'))->persistent('OK');
         return redirect()->route('products.index');
       }

       /**
       * Display the specified resource.
       *
       * @param  \App\Product  $product
       * @return \Illuminate\Http\Response
       */
       public function show(Product $product)
       {
         return view('products.show')->withProduct($product);
       }

       public function showHomeproduct()
       {
         return view('products.show')->withProduct(Product::first());
       }
       /**
       * Show the form for editing the specified resource.
       *
       * @param  \App\Product  $product
       * @return \Illuminate\Http\Response
       */
       public function edit(Product $product)
       {
         return view('products.edit')->withProduct($product);
       }

       /**
       * Update the specified resource in storage.
       *
       * @param  \App\Http\Requests\ProductRequest  $request
       * @param  \App\Product  $product
       * @return \Illuminate\Http\Response
       */
       public function update(ProductRequest $request, Product $product)
       {
         $product->update($request->all());
         alert()->success( __('Product updated!'), __('Success'))->persistent('OK');
         return redirect()->route('products.index');
       }

       /**
       * Remove the specified resource from storage.
       *
       * @param  \App\Product  $product
       * @return \Illuminate\Http\Response
       */
       public function destroy(Product $product)
       {
         $product->delete();
         alert()->success( __('Product deleted!'), __('Success'))->persistent('OK');
         return redirect()->route('products.index');
       }
}
