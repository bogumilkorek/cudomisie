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
          {{ $product->price }} {{__('$') }}
        </h3>
        <br />
        <a href="{{ route('user.products.show', [$product->categories->first(), $product]) }}" class="btn-dashed">
          <i class="fa fa-share" aria-hidden="true"></i> {{ __('Show more') }}
        </a>
      </div>
      </div>

      @endforeach

    </div>

    @empty
      <h4>
        {{ __('No data') }}
      </h4>

    @endforelse

  </div>

</div>
