<div class="container">

  <h1>
    {{ $title }}
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  </h1>
  <hr>

  <div class="container-fluid">

    @forelse($products->chunk(3) as $productRow)

      <div class="row is-flex">

        @foreach ($productRow as $product)

          <div class="col-md-4">
            <div class="product-card">
              <img src="{{ $product->images->first()->thumbnail_url }}">
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
              <input type="number" min="1" max="9" class="form-control text-center btn-dashed" value="1" data-slug="{{ $product->slug }}" style="display: inline-block; width: 70px; padding: 24px 5px; font-family: Noto Sans; margin-right: 0px">
              <a href="#" class="btn btn-dashed cart-add" style="margin-left: 4px" data-slug="{{ $product->slug }}">
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
