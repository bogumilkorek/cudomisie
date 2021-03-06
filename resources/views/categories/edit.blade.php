@extends('layouts.admin')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>{{ __('Edit category') }}</h1>
        <hr>

        @component('alert', ['errors' => $errors])
        @endcomponent
        
        <form method="POST" action="{{ route('categories.update', $category) }}">
          {{ csrf_field() }}
          {{ method_field('PUT') }}

          @include('categories.form')

          <input type="hidden" name="id" value="{{ $category->id }}" />

          <button type="submit" class="btn btn-primary"
          data-loading-text="<i class='fa fa-cog fa-spin'></i> {{ __('Loading') }}">
          {{ __('Save') }}
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-default">{{ __('Cancel') }}</a>
      </form>

    </div>
  </div>
</div>

@include('layouts.partials.admin.wysiwyg')

@push('scripts')
  <script>
  $(".selectpicker").selectpicker('val', '{{ $category->parent_id }}');
  </script>
@endpush

@endsection
