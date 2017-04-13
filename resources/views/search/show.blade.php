@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">
      <h1>
        <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
        {{ __('Search') }}: {{ $keyword }}
      </h1>
      <hr>

      <form method="GET" action="{{ route('user.search') }}">
        <div class="input-group col-md-2 col-md-offset-5">
          <input type="text" class="form-control" name="q" placeholder="{{ __('Search') }}" required minlength="5">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </span>
        </div>
      </form>
      <br /><br />

      @if(empty($keyword) || ($products->isEmpty() && $blog_posts->isEmpty() && $pages->isEmpty()))
        <h2>
          {{ __('No data') }}
        </h2>
      @else
        @if(!$products->isEmpty())
          @component('components.productGrid', [
            'title' => __('Found products'),
            'products' => $products,
            'pagination' => false
          ])
        @endcomponent
      @endif

      @if(!$blog_posts->isEmpty())
        @component('components.postGrid', [
          'title' => __('Found blog posts'),
          'posts' => $blog_posts,
          'pagination' => false
        ])
      @endcomponent
    @endif

    @if(!$pages->isEmpty())
      <h1>
        {{ __('Found pages') }}
        <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
      </h1>
      <hr>

      <ul>
        @foreach($pages as $page)
          <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
          <a href="{{ route('user.pages.show', $page) }}">{{ $page->title }}</a>
          <br />
        @endforeach
      </ul>
    @endif

  @endif

</div>
</div>
@endsection
