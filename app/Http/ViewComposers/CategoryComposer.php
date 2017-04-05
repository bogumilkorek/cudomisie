<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Category;


class CategoryComposer
{
  public function compose(View $view)
  {
    $categories = Category::orderBy('title', 'asc')
    ->where('parent_id', NULL)
    ->get();

    $view->with('categories', $categories);
  }
}
