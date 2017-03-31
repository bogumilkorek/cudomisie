<div class="container">

  <h1>
    {{ __('Latest articles') }}
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  </h1>
  <hr>

  <div class="container-fluid">

    @forelse (array_chunk($posts->all(), 3) as $postRow)

    <div class="row is-flex">

      @foreach ($postRow as $post)

      <div class="col-md-4">
        <div class="product-card">
          <img src="{{ $post->images->first()->url }}">
        <p class="match">
          {{ $post->title }}
        </p>
        {{ $post->created_at }}
        <br /><br />
        <a href="{{ route('user.blogPosts.show', $post) }}" class="btn-dashed">
          <i class="fa fa-share" aria-hidden="true"></i> {{ __('Show more') }}
        </a>
      </div>
      </div>

      @endforeach

    </div>

    @empty
      <h3>
        {{ __('No data') }}
      </h3>

    @endforelse

  </div>

  <div class="text-center">
    {{ $posts->links() }}
  </div>

</div>