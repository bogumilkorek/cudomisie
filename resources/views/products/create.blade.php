@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>{{ __('Add new product') }}</h2>
      <hr>

      @component('alert', ['errors' => $errors])
      @endcomponent

      <form method="POST" action="{{ route('products.store') }}">
        {{ csrf_field() }}

        @include('products.form')

        <div class="dropzone" id="dropzoneFileUpload"></div>

        <button type="submit" class="btn btn-primary"
          data-loading-text="<i class='fa fa-cog fa-spin'></i>
          {{ __('Loading') }}">{{ __('Save') }}
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-default">{{ __('Cancel') }}</a>
      </form>
  </div>
</div>
</div>

@include('layouts.partials.admin.wysiwyg')

@push('scripts')
  <script type="text/javascript">
    $('select').select2();
    $("#dropzoneFileUpload").dropzone({
                url: "my-upload-url",
            });


  </script>
@endpush

@endsection
