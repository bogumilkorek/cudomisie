<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
  public function show(Request $request)
  {
      //$request->session()->get('key');

  }
  public function addItem(Request $request)
  {
      //
  }
  public function removeItem(Request $request)
  {
      //$request->session()->forget('key')
  }
  public function update(Request $request)
  {
      //
  }
  public function clear(Request $request)
  {
      $request->session()->flush();
  }
}
