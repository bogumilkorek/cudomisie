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
      <input type="hidden" name="type" value="{{ Request::segment(2) }}" />
      <input type="hidden" name="id" value="{{ $product->id ?? 0 }}" />
    </form>
  </div>
</div>

@push('scripts')

<script type="text/javascript">

$("#images-dropzone").dropzone({
  paramName: "image",
  maxFilesize: 8,
  uploadMultiple: false,
  parallelUploads: 1,
  addRemoveLinks: true,
  dictCancelUpload: '{{ __('Cancel') }}',
  dictCancelUploadConfirmation: '{{ __('Are you sure?') }}',
  dictRemoveFile: '{{ __('Remove') }}',
  dictFileTooBig: '{{ __('Image is bigger than 8 MB') }}',
  accept: function(file, done) { done() },
  init: function() {
    this.on("removedfile", function(file) {
      $.ajax({
        type: 'DELETE',
        url: '{{ route('images.destroy') }}',
        data: { url: $(file.previewElement).find('[data-dz-name]').html() }
      });
    });

    this.on("success", function(file, response) {
      $(file.previewElement).find('[data-dz-name]').html(response.filename);
    });

    @if(!empty($images))
      @foreach($images as $image)
        var mockFile = { name: '{{ $image->url }}', size: {{ $image->size }} };
        this.emit("addedfile", mockFile);
        this.emit("thumbnail", mockFile, "{{ $image->thumbnail_url }}");
        this.createThumbnailFromUrl(mockFile, '{{ $image->url }}');
        this.emit("complete", mockFile);
      @endforeach
    @endif
  }
});

</script>

@endpush
