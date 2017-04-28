<div class="container">

  <h1>
    {!! $title !!}
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" alt="" title="" />
  </h1>
  <hr>

  <div class="container-fluid">
    @forelse($products->chunk(3) as $productRow)
      <div class="row is-flex">
        @foreach ($productRow as $product)
          <div class="col-md-4">
            <div class="product-card">
              <img src="{{ $product->images->first()->thumbnail_url }}" alt="" title="">
              <p class="match">
                {{ $product->title }}
              </p>
              @if($product->trashed())
                <h5>
                  <strong class="alert alert-danger">{{ __('Product temporary unavailable') }}</strong>
                </h5>
              @else
                <h3>
                  {{ $product->price }}
                </h3>
              @endif
              <br />
              @if(!$product->trashed())
                <a href="{{ route('user.products.show', [$product->categories->first()->parent, $product->categories->first(), $product]) }}" class="btn-dashed">
                  <i class="fa fa-share" aria-hidden="true"></i> {{ __('Show more') }}
                </a>
                <!--<input type="number" min="1" max="9" class="form-control text-center btn-dashed" value="1" data-slug="{{ $product->slug }}">-->
                <a href="#" class="btn btn-dashed cart-add" data-slug="{{ $product->slug }}">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
              @endif
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
