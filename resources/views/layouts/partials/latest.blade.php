<section id="latest">

  <div class="container">

    <h1>
      {{ __('Newest products') }}
      <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
    </h1>
    <hr>

    <div class="products-wrapper">
      @foreach ($latestProducts as $ltProduct)
        <div class="product">
          {{ $ltProduct->name }}
        </div>
      @endforeach
    </div>

  </div>

</section>
