@extends('layouts.admin')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2>{{ __('Add new product') }}</h2>
        <hr>

        @component('alert', ['errors' => $errors])
        @endcomponent

        <form method="POST" action="{{ route('products.store') }}" id="form-with-wysiwyg" data-validate='["title", "categories[]", "price", "dimensions"]' data-validate-dropzone='true'>
          {{ csrf_field() }}

          @include('products.form')

          <button type="submit" class="btn btn-primary"
          data-loading-text="<i class='fa fa-cog fa-spin'></i>
          {{ __('Loading') }}">{{ __('Save') }}
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-default">{{ __('Cancel') }}</a>
      </form>
    </div>
  </div>

    @include('layouts.partials.admin.dropzone')

</div>

@include('layouts.partials.admin.wysiwyg')

@include('layouts.partials.admin.frontendValidation')

@push('scripts')
  <script type="text/javascript">
  $(".selectpicker, .selectpicker-shipping").selectpicker();
  </script>
@endpush

@endsection
