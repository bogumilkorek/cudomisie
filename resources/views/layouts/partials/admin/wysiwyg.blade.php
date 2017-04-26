@push('scripts')
  <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.6.2/adapters/jquery.js" type="text/javascript"></script>
  <script type="text/javascript">

  $('textarea.editor').ckeditor({
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
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

  // Lousy frontend validation
  $('button[type=submit]').on('click', function(e) {
    var proceed = true;
    var validate = $('#form-with-wysiwyg').data('validate');
    validate.forEach(function(key, index) {
      if($('*[name="'+key+'"]').val().length == 0)
      proceed = false;
    });

    if(proceed)
    {
      e.preventDefault();
      if($('textarea.editor').val().length == 0)
      swal("{{ __('Error') }}", "{{ __('Field description is required') }}", "error");
      else
      $(this).parents('form').submit();
    }

  });

  </script>
@endpush
