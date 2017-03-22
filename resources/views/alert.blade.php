@if (count($errors) > 0)
  @php
    $msg = "";
    foreach($errors->all() as $error)
      $msg .= "- $error<br />";
    alert()->error($msg, __('Error'))->html()->persistent(__('Close'));
    @endphp
@endif

<!-- Another way -->
<!--
  @if (count($errors) > 0)
  <div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
 -->
