<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Product;
use App\BlogPost;

class SearchController extends Controller
{
    public function search($keywords = NULL)
    {
      return view('search.show')->withKeywords($keywords);
    }
}
