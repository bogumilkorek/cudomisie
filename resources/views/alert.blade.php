@if (count($errors) > 0)
  @php
    $msg = "";
    foreach($errors->all() as $error)
      $msg .= "- $error<br />";
    alert()->error($msg, __('Error'))->html()->persistent(__('Close'));
    @endphp
@endif
