@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>{{ __('Edit product') }}</h1>
      <hr>

      @component('alert', ['errors' => $errors])
      @endcomponent

      <form method="POST" action="{{ route('products.update', $product) }}" id="form-with-wysiwyg" data-validate='["title", "categories[]", "price", "dimensions"]>
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @include('products.form')

        <input type="hidden" name="id" value="{{ $product->id }}" />

        <button type="submit" class="btn btn-primary" data-loading-text="<i class='fa fa-cog fa-spin'></i> {{ __('Loading') }}">
          {{ __('Save') }}
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-default">{{ __('Cancel') }}</a>
      </form>
    </div>
  </div>

  @include('layouts.partials.admin.dropzone')

</div>

@include('layouts.partials.admin.wysiwyg')

@push('scripts')

<script type="text/javascript">

$(".selectpicker").selectpicker('val', {!! json_encode($product->categories()->pluck('categories.id')) !!});

$(".selectpicker-shipping").selectpicker('val', {!! json_encode($product->shippingMethods()->pluck('shipping_methods.id')) !!});

</script>

@endpush

@endsection
