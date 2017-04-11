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
    $this->middleware(['auth', 'admin'])->except(['indexUser', 'show']);
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $products = Product::where('deleted_at', NULL)
    ->orderBy('id', 'desc')
    ->with('categories')
    ->with('images')
    ->get();

    return view('products.index')->withProducts($products);
  }

  public function indexUser()
  {
    $products = Product::where('deleted_at', NULL)
    ->orderBy('id', 'desc')
    ->with('categories')
    ->with('images')
    ->paginate(9);

    return view('products.indexUser')->withProducts($products);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('products.create')
    ->withCategories(Category::where('parent_id', NULL)->get());
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \App\Http\Requests\ProductRequest  $request
  * @return \Illuminate\Http\Response
  */
  public function store(ProductRequest $request)
  {
    Product::create($request->all())
    ->categories()->sync($request->categories, false);

    alert()->success( __('Product created!'), __('Success'))->persistent('OK');
    return redirect()->route('products.index');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Product  $product
  * @return \Illuminate\Http\Response
  */
  public function show(Category $category, Product $product)
  {
    return view('products.show')->withProduct($product);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Product  $product
  * @return \Illuminate\Http\Response
  */
  public function edit(Product $product)
  {

    //return json_encode(Category::wherePivot('product_id', $product->id)->get());

    //$product = $product->where('id', $product->id)->with('categories')->get();

    //Category::wherePivot('product_id', $product->id);



    return view('products.edit')->withProduct($product)
    ->withCategories(Category::all());
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

    if(isset($request->categories))
    $product->categories()->sync($request->categories);
    else
    $product->categories()->sync(array());

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
