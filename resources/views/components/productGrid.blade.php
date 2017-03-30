<div class="container">

  <h1>
    {{ $title }}
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  </h1>
  <hr>

  <div class="container-fluid">

    @forelse (array_chunk($products->all(), 3) as $productRow)

    <div class="row is-flex">

      @foreach ($productRow as $product)

      <div class="col-md-4">
        <div class="product-card">
          <img src="{{ $product->images->first()->url }}">
        <p class="match">
          {{ $product->title }}
        </p>
        <h3>
          {{ $product->price }}
        </h3>
        <br />
        <a href="{{ route('user.products.show', [$product->categories->first(), $product]) }}" class="btn-dashed">
          <i class="fa fa-share" aria-hidden="true"></i> {{ __('Show more') }}
        </a>
        <a href="{{ route('cart.add', $product) }}" class="btn btn-dashed">
          <i class="fa fa-shopping-cart" aria-hidden="true"></i>
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

  @if($pagination)
  <div class="text-center">
    {{ $products->links() }}
  </div>
  @endif

</div>
