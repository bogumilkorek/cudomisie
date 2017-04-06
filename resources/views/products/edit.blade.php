@extends('layouts.admin')

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>{{ __('Edit product') }}</h1>
        <hr>

        @component('alert', ['errors' => $errors])
        @endcomponent

        <form method="POST" action="{{ route('products.update', $product) }}">
          {{ csrf_field() }}
          {{ method_field('PUT') }}

          @include('products.form')

          <input type="hidden" name="id" value="{{ $product->id }}" />

          <button type="submit" class="btn btn-primary"
          data-loading-text="<i class='fa fa-cog fa-spin'></i> {{ __('Loading') }}">
          {{ __('Save') }}
        </button>
        <a href="{{ url()->previous() }}" class="btn btn-default">{{ __('Cancel') }}</a>
      </form>

    </div>
  </div>
  <br /><br />
  <div class="row">
    <div class="col-md-12">
      <h2>{{ __('Pictures') }}</h2>
      <hr>
      <form method="POST" action="{{ route('images.store') }}" class="dropzone" id="images-dropzone" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="dz-message">
          <h4 style="text-align: center;color:#428bca;">{{ __('Drop images in this area') }}<span class="glyphicon glyphicon-hand-down"></span></h4>
        </div>
        <input type="hidden" name="type" value="products" />
        <input type="hidden" name="id" value="{{ $product->id }}" />
      </form>
    </div>
  </div>
</div>

@include('layouts.partials.admin.wysiwyg')

@push('scripts')

  <script type="text/javascript">
  $(".selectpicker").selectpicker('val', {!! json_encode($product->categories()->pluck('categories.id')) !!});

  $("#images-dropzone").dropzone({
    paramName           :       "image", // The name that will be used to transfer the file
    maxFilesize         :       8, // MB
    uploadMultiple      :       false,
    parallelUploads     :       1,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove',
    dictFileTooBig: 'Image is bigger than 8MB',
    accept              :       function(file, done) { done() },
    init: function() {

      this.on("removedfile", function(file) {
            $.ajax({
                type: 'DELETE',
                url: '{{ route('images.destroy') }}',
                data: {id: file.name },
                dataType: 'html',
                success: function(data) {alert(data)}
            });

        } );


      @foreach($product->images as $image)
      var mockFile = { name: '{{ $image->url }}', size: 1234567 };
      this.emit("addedfile", mockFile);
      this.emit("thumbnail", mockFile, "{{ $image->url }}");
      this.createThumbnailFromUrl(mockFile, '{{ $image->url }}');
      this.emit("complete", mockFile);
      @endforeach
    }
  });
  </script>
@endpush

@endsection
