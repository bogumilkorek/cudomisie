@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
    <div class="panel-body">
      <h1>
        {{ __('Payment verification') }}
      </h1>

      <hr>

      <h2><i class="fa fa-refresh fa-spin fa-x fa-fw"></i></h2>
      <h3>{{ __('Please wait') }}...</h3>

    </div>
  </div>

  @push('scripts')
    <script type="text/javascript">

    let tries = 0;

    setInterval(function(){

      $.ajax({
        method: "POST",
        url: "/pay/check",
        data: { id: '{{ $uuid ?? 0 }}' }
      })
      .done(function(response) {
        if(response.message == 'Payment verified')
        window.location.href = 'payment-completed';
        else if(response.message == 'Payment error')
        window.location.href = 'payment-error';
        else if(response.message == 'Payment not verified')
        {
          tries++;
          if(tries > 50)
          window.location.href = 'payment-error';
        }
        else
        window.location.href = '404';
      });

    }, 3000);

    </script>
  @endpush

@endsection
