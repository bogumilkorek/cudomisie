<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostRequest;
use App\BlogPost;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogPostController extends Controller
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
    $blogPosts = BlogPost::orderBy('title', 'asc')->get();
    return view('blogPosts.index')->withBlogPosts($blogPosts);
  }
  public function indexUser()
  {
    $blogPosts = BlogPost::orderBy('id', 'desc')
    ->with('images')
    ->paginate(9);

    return view('blogPosts.indexUser')->withBlogPosts($blogPosts);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create(Request $request)
  {
    return view('blogPosts.create')
    ->withImages(Image::where('form_token', $request->session()->token())->get());
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \App\Http\Requests\BlogPostRequest  $request
  * @return \Illuminate\Http\Response
  */
  public function store(BlogPostRequest $request)
  {
    $blogPost = BlogPost::create($request->all());

    // Update images added via Dropzone (set new id)
    Image::where('form_token', $request->_token)->update(['imageable_id' => $blogPost->id, 'form_token' => NULL]);
    $request->session()->regenerateToken();

    alert()->success(__('Blog post created!'), __('Success'))->persistent('OK');
    return redirect()->route('blogPosts.index');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\BlogPost  $blogPost
  * @return \Illuminate\Http\Response
  */
  public function show(BlogPost $blogPost)
  {
    return view('blogPosts.show')->withBlogPost($blogPost);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Posts  $Posts
  * @return \Illuminate\Http\Response
  */
  public function edit(BlogPost $blogPost)
  {
    return view('blogPosts.edit')
    ->withBlogPost($blogPost)
    ->withImages($blogPost->images);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \App\Http\Requests\BlogPostRequest  $request
  * @param  \App\BlogPost  $blogPost
  * @return \Illuminate\Http\Response
  */
  public function update(BlogPostRequest $request, BlogPost $blogPost)
  {
    $blogPost->update($request->all());
    alert()->success( __('Blog post updated!'), __('Success'))->persistent('OK');
    return redirect()->route('blogPosts.index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\BlogPost  $blogPost
  * @return \Illuminate\Http\Response
  */
  public function destroy(BlogPost $blogPost)
  {
    $images = Image::where([
      ['imageable_id', $blogPost->id],
      ['imageable_type', 'blogPosts']
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

      $blogPost->delete();
      alert()->success( __('Blog post deleted!'), __('Success'))->persistent('OK');
      return redirect()->route('blogPosts.index');
    }
  }
