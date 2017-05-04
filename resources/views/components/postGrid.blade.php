<div class="container">

  <h1>
    {{ $title ?? __('Latest articles') }}

  </h1>
  <hr>

  <div class="container-fluid">
    @forelse($posts->chunk(3) as $postRow)
      <div class="row is-flex">
        @foreach ($postRow as $post)
          <div class="col-md-4">
            <div class="product-card">
              <img src="{{ $post->images->first()->thumbnail_url }}">
              <span class="date"><i class="fa fa-clock-o" aria-hidden="true"></i> {{ $post->created_at }}</span>
              <p class="match">
                {{ $post->title }}
              </p>
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

  @if(!empty($pagination))
    <div class="text-center">
      {{ $products->links() }}
    </div>
  @endif

</div>
