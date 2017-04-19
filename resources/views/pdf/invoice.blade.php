<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link rel="stylesheet" href="{{ ltrim(mix('/css/app.css'), '/') }}" type="text/css" />
  <style>
  *{font-family: DejaVu Sans !important;}
  </style>
</head>
<body style="background: #FFF; font-size: 11px;">
  <div class="text-center">
    <img src="{{ asset('images/cudomisie-logo.png') }}" width="150px" />
  </div>
  <b>Faktura nr:</b> CM/{{ $order->id }}/{{ date('Y') }}
  <br /><br />
  <b>Data wystawienia:</b> {{ $order->created_at }}<br />
  <b>Termin płatności:</b> {{ $order->created_at }}<br />
  <b>Płatność:</b> przelew
  <br /><br />
  <table class="table">
    <tr><td>
      <b>Sprzedawca:</b><br />
      Pracownia Cudomisie<br />
      ul. Rzemieślnicza 18<br />
      72-320 Trzebiatów<br />
      Rachunek: PKO BP Oddział w Kołobrzegu<br />
      Nr konta: 21 1020 2821 0000 1702 0022 1242<br />
      NIP: 857-100-68-56
    </td><td>
      <b>Nabywca:</b><br />
      {{ $order->name }}<br />
      {{ $order->address }}
    </td></tr></table>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>LP</th>
          <th>Nazwa towaru</th>
          <th>Cena</th>
          <th>Ilość</th>
          <th>Wartość</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->products as $index => $product)
        <tr>
          <td>{{ ++$index }}</td>
          <td>{{ $product->pivot->product_title }}</td>
          <td>{{ $product->pivot->product_price }}</td>
          <td>{{ $product->pivot->product_quantity }}</td>
          <td>{{ $product->pivot->product_quantity * floatval($product->pivot->product_price) . ' ' . __('$') }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <td></td>
          <td>{{ __('Shipping method') }}:</td>
          <td>{{ $order->shipping_method_name }}</td>
          <td>{{ $order->shipping_cost }}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td><b>Razem:</b></td>
          <td><b>{{ $order->total_cost }}</b></td>
        </tr>
      </tfoot>
    </table>
    <h6>Do zapłaty: {{ $order->total_cost }} (słownie: {{ $cost_words }})</h6>
  </body>
  </html>
