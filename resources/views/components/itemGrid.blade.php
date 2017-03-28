<div class="container">

  <h1>
    {{ $title }}
    <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
  </h1>
  <hr>

  <div class="container-fluid">

    @forelse (array_chunk($items->all(), 3) as $itemRow)

    <div class="row is-flex">

      @foreach ($itemRow as $item)

      <div class="col-md-4">
        <div class="product-card">
          <img src="{{ $item->images->first()->url }}">
        <p class="match">
          {{ $item->title }}
        </p>
        <h3>
          {{ $item->price }} {{__('$') }}
        </h3>
        <br />
        <a href="{{ route('user.products.show', [$item->categories->first(), $item]) }}" class="btn-dashed">
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
