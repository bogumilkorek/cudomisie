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
  <b>Faktura VAT numer:</b> CM/{{ $order->id }}/{{ date('Y') }}<br />
  <b>Data wystawienia:</b> {{ str_limit($order->created_at, 10, '') }}<br />
  <b>Termin płatności:</b> {{ str_limit($order->created_at, 10, '') }}<br />
  <b>Sposób płatności:</b>
  @if($order->status == 1)
    przelew
  @else
    za pobraniem
  @endif
  <br /><br />
  <table class="table">
    <tr><td>
      <b>Sprzedawca:</b><br />
      FHU Hurt - Krzyś<br />
      Tadeusz Pyzia<br />
      ul. Rzemieślnicza 18<br />
      72-320 Trzebiatów<br />
      tel. 502 336 103<br />
      NIP: 857-100-68-56<br />
      Rachunek: PKO BP Oddział w Kołobrzegu<br />
      Nr konta: 21 1020 2821 0000 1702 0022 1242
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
          <th>Ilość</th>
          <th>Cena netto</th>
          <th>Wartość netto</th>
          <th>VAT</th>
          <th>Wartość VAT</th>
          <th>Wartość brutto</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order->products as $index => $product)
        <tr>
          <td>{{ ++$index }}</td>
          <td>{{ $product->pivot->product_title }}</td>
          <td>{{ $product->pivot->product_quantity }}</td>
          <td>{{ $product->post_tax_price }}</td>
          <td>{{ $product->post_tax_price }}</td>
          <td>23%</td>
          <td>{{ $product->price_tax }}</td>
          <td>{{ $product->pivot->product_price }}</td>
          <!-- <td>{{ $product->pivot->product_price }}</td>
          <td>{{ number_format($product->pivot->product_quantity * floatval($product->pivot->product_price), 2) . ' ' . __('$') }}</td> -->
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td></td>
          <td>{{ __('Shipping method') }}: {{ $order->shipping_method_name }}</td>
          <td>1</td>
          <td>{{ $order->post_tax_shipping }}</td>
          <td>{{ $order->post_tax_shipping }}</td>
          <td>23%</td>
          <td>{{ $order->shipping_tax }}</td>
          <td>{{ $order->shipping_cost }}</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td><b>Razem:</b></td>
          <td><b>{{ $order->post_tax_total }}</b></td>
          <td><b>{{ $order->post_tax_total }}</b></td>
          <td><b>23%</b></td>
          <td><b>{{ $order->total_tax }}</b></td>
          <td><b>{{ $order->total_cost }}</b></td>
        </tr>
      </tfoot>
    </table>
    <h6>Do zapłaty: {{ $order->total_cost }} (słownie: {{ $cost_words }})</h6>
  </body>
  </html>
