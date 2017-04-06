@extends('layouts.admin')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>{{ __('Add new category') }}</h2>
      <hr>

      @component('alert', ['errors' => $errors])
      @endcomponent

      <form method="POST" action="{{ route('categories.store') }}">
        {{ csrf_field() }}

        @include('categories.form')

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
    <script>
    $(".selectpicker").selectpicker();
</script>
@endpush

@endsection
