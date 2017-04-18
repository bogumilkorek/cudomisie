<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Page;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
  public function __construct()
  {
      $this->middleware(['auth', 'admin'])->except(['show', 'showHomepage']);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
      $pages = Page::orderBy('title', 'asc')->get();
      return view('pages.index')
      ->withPages($pages);
  }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
      return view('pages.create')
      ->withImages(Image::where('form_token', $request->session()->token())->get());
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \App\Http\Requests\PageRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function store(PageRequest $request)
    {
      $page = Page::create($request->all());
      Image::where('form_token', $request->_token)->update(['imageable_id' => $page->id, 'form_token' => NULL]);
      $request->session()->regenerateToken();

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
      return view('pages.show')->withPage(Page::first())
      ->withSlider(true);
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Page  $page
    * @return \Illuminate\Http\Response
    */
    public function edit(Page $page)
    {
      return view('pages.edit')
      ->withPage($page)
      ->withImages($page->images);
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
      if($page->id == 1)
      {
        alert()->error( __('Homepage cannot be deleted!'), __('Error'))->persistent('OK');
        return redirect()->back();
      }

      $images = Image::where([
        ['imageable_id', $page->id],
        ['imageable_type', 'pages']
        ])->get();

        if($images->isNotEmpty())
        {
          foreach($images as $image)
          {
            if(File::exists(public_path('/photos/upload/' . $image->url)))
            File::delete(public_path('/photos/upload/' . $image->url));
            if(File::exists(public_path('/photos/upload/thumbs/' . $image->url)))
            File::delete(public_path('/photos/upload/thumbs/' . $image->url));

            $image->delete();
          }
        }

      $page->delete();
      alert()->success( __('Page deleted!'), __('Success'))->persistent('OK');
      return redirect()->route('pages.index');
    }
  }
