<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Alert;

class CategoryController extends Controller
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
         $categories = Category::orderBy('title', 'asc')
         ->with('products')
         ->get();
         return view('categories.index')->withCategories($categories);
     }

       /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
       public function create()
       {
         return view('categories.create');
       }

       /**
       * Store a newly created resource in storage.
       *
       * @param  \App\Http\Requests\CategoryRequest  $request
       * @return \Illuminate\Http\Response
       */
       public function store(CategoryRequest $request)
       {
         Category::create($request->all());
         alert()->success( __('Category created!'), __('Success'))->persistent('OK');
         return redirect()->route('categories.index');
       }

       /**
       * Display the specified resource.
       *
       * @param  \App\Category  $category
       * @return \Illuminate\Http\Response
       */
       public function show(Category $category)
       {
         $products = Product::whereHas('categories', function($q) use($category) {
           $q->where('category_id', '=', $category->id);
         })->get();

         return view('categories.show')->withCategory($category)->withProducts($products);
       }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $Posts
     * @return \Illuminate\Http\Response
     */
     public function edit(Category $category)
     {
       return view('categories.edit')->withCategory($category);
     }

     /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
     public function update(CategoryRequest $request, Category $category)
     {
       $category->update($request->all());
       alert()->success( __('Category updated!'), __('Success'))->persistent('OK');
       return redirect()->route('categories.index');
     }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
     public function destroy(Category $category)
     {
       $category->delete();
       alert()->success( __('Category deleted!'), __('Success'))->persistent('OK');
       return redirect()->route('categories.index');
     }
}
