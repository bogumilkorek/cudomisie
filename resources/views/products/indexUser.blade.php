@extends('layouts.app')

@section('content')

  @component('components.productGrid', [
    'title' => __('Products'),
    'products' => $products,
    'pagination' => true
  ])
@endcomponent

@endsection
