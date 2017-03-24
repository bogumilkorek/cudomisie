<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostsRequest;
use App\BlogPost;
use Illuminate\Http\Request;
use Alert;

class BlogPostController extends Controller
{
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

       /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
       public function create()
       {
         return view('blogPosts.create');
       }

       /**
       * Store a newly created resource in storage.
       *
       * @param  \App\Http\Requests\BlogPostsRequest  $request
       * @return \Illuminate\Http\Response
       */
       public function store(BlogPostsRequest $request)
       {
         BlogPost::create($request->all());
         alert()->success( __('Blog post created!'), __('Success'))->persistent('OK');
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
       return view('blogPosts.edit')->withBlogPost($blogPost);
     }

     /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\BlogPostsRequest  $request
     * @param  \App\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
     public function update(BlogPostsRequest $request, BlogPost $blogPost)
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
       $blogPost->delete();
       alert()->success( __('Blog post deleted!'), __('Success'))->persistent('OK');
       return redirect()->route('blogPosts.index');
     }
}
