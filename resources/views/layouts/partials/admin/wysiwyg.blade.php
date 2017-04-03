@push('scripts')
  <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.6.2/adapters/jquery.js" type="text/javascript"></script>
  <script type="text/javascript">

  var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };

  $('textarea').ckeditor({
    on: {
      instanceReady: function (evt) {
        evt.editor.document.getBody().setStyles({
          'color': '#444',
          'font-size': '14px',
          'font-family': 'Noto+Sans'
        });
      }
  }
  });


  // // Frontend validation
  // $('button[type=submit]').on('click', function(e) {
  //   if(CKEDITOR.instances.content.getData() == "")
  //     swal("Oops...", "Something went wrong!", "error");
  //   else
  //   $(this).parents('form').submit();
  //
  // });

  </script>
@endpush
