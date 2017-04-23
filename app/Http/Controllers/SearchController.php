<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Product;
use App\BlogPost;

class SearchController extends Controller
{
    public function search(Request $request)
    {
      $keyword = $request->q;

      if($keyword)
      {
        $products = Product::where('title', 'LIKE', '%' . $keyword . '%')
        ->orWhere('description', 'LIKE', '%' . $keyword . '%')
        ->withTrashed()
        ->get();

        $blogPosts = BlogPost::where('title', 'LIKE', '%' . $keyword . '%')
        ->orWhere('content', 'LIKE', '%' . $keyword . '%')
        ->get();

        $pages = Page::where('title', 'LIKE', '%' . $keyword . '%')
        ->orWhere('content', 'LIKE', '%' . $keyword . '%')
        ->get();

        return view('search.show')->withKeyword($keyword)
        ->withProducts($products)
        ->withBlogPosts($blogPosts)
        ->withPages($pages);
      }
      return view('search.show')->withKeyword($keyword);
    }
}
