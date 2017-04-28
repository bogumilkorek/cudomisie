@push('scripts')
  <script type="text/javascript">
  // Frontend validation
  $('button[type=submit]').on('click', function(e) {
    var proceed = true;
    var validate = $('#form-with-wysiwyg').data('validate');
    validate.forEach(function(key, index) {
      if($('*[name="'+key+'"]').val().length == 0)
      proceed = false;
    });

    if(proceed)
    {
      if($('textarea.editor').val().length == 0)
      {
        e.preventDefault();
        swal("{{ __('Error') }}", "{{ __('Field description is required') }}", "error");
      }
      else if(!$('.dz-remove:first').length)
      {
        e.preventDefault();
        swal("{{ __('Error') }}", "{{ __('Add some images') }}", "error");
      }
      else
      $(this).parents('form').submit();
    }
  });

  </script>

@endpush
