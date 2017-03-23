<section id="latest">

  <div class="container">

    <h1>
      {{ __('Newest products') }}
      <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
    </h1>
    <hr>

    <div class="container-fluid">

      @forelse (array_chunk($latestProducts->all(), 3) as $ltProductRow)

      <div class="row is-flex">

        @foreach ($ltProductRow as $ltProduct)

        <div class="col-md-4">
          <div class="product-card">
            <img src="{{ $ltProduct->images->first()->url }}">
          <p class="match">
            {{ $ltProduct->title }}
          </p>
          <h3>
            {{ $ltProduct->price }} {{__('$') }}
          </h3>
          <br />
          <a href="{{ $ltProduct->categories->first()->slug }}/{{ $ltProduct->slug }}" class="btn-dashed">
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

  </section>
