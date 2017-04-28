@extends('layouts.app')

@section('content')

  @component('components.productGrid', [
    'title' => $category->title,
    'products' => $products,
    'pagination' => false
  ])
@endcomponent

@endsection
