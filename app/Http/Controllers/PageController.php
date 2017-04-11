<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Page;
use Illuminate\Http\Request;
use Alert;

class PageController extends Controller
{


  public function __construct()
  {
      $this->middleware('admin')->except(['show', 'showHomepage']);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
      $pages = Page::orderBy('title', 'asc')->get();
      return view('pages.index')->withPages($pages);
  }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
      return view('pages.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \App\Http\Requests\PageRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function store(PageRequest $request)
    {
      Page::create($request->all());
      alert()->success( __('Page created!'), __('Success'))->persistent('OK');
      return redirect()->route('pages.index');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Page  $page
    * @return \Illuminate\Http\Response
    */
    public function show(Page $page)
    {
      return view('pages.show')->withPage($page);
    }

    public function showHomepage()
    {
      return view('pages.show')->withPage(Page::first());
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Page  $page
    * @return \Illuminate\Http\Response
    */
    public function edit(Page $page)
    {
      return view('pages.edit')->withPage($page);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \App\Http\Requests\PageRequest  $request
    * @param  \App\Page  $page
    * @return \Illuminate\Http\Response
    */
    public function update(PageRequest $request, Page $page)
    {
      $page->update($request->all());
      alert()->success( __('Page updated!'), __('Success'))->persistent('OK');
      return redirect()->route('pages.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Page  $page
    * @return \Illuminate\Http\Response
    */
    public function destroy(Page $page)
    {
      $page->delete();
      alert()->success( __('Page deleted!'), __('Success'))->persistent('OK');
      return redirect()->route('pages.index');
    }
  }
