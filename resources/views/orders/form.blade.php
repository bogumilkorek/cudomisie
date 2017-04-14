<div class="form-group">
<h4> {{ __('Select shipping method') }}:</h4>
@foreach($shipping_methods as $sMethod)
  <div class="form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="radio" name="shippingMethodId" id="shippingMethodId" value="{{ $sMethod->id }}" required>
      {{ $sMethod->title }} ({{ $sMethod->price }})
    </label>
  </div>
@endforeach
</div>

<h4> {{ __('Fill in shipping data') }}:</h4>
<div class="form-group">
  <label for="name">{{ __('Name') }}:</label>
  <input type="text" pattern="[^\s]{3,} [^\s]{3,}" class="form-control" name="name"
  value="{{ old('name', Auth::user()->name ?? '') }}" required autofocus>
</div>

<div class="form-group">
  <label for="email">{{ __('E-mail') }}:</label>
  <input type="email" class="form-control" name="email"
  value="{{ old('email', Auth::user()->email ?? '') }}" required>
</div>

<div class="form-group">
  <label for="phone">{{ __('Phone') }}:</label>
  <input type="text" pattern="((\+|00)[0-9]{2})?[0-9]{9}" class="form-control"
  name="phone" title="{{ __('Phone number must be 9 digits') }}."
  value="{{ old('phone',  Auth::user()->phone ?? '') }}" required>
</div>

<div class="form-group">
  <label for="street">{{ __('Street and house number') }}:</label>
  <input type="text" pattern="[^\s]+ [0-9]{1,3}([a-zA-Z])?(\/[0-9]{1,3})?" class="form-control"
  name="street" title="{{ __('Correct form') }}: Rzemieślnicza 18, Rzemieślnicza 18a/3"
  value="{{ old('street',  Auth::user()->street ?? '') }}" required>
</div>

<div class="form-group">
  <label for="city">{{ __('Zip code and city') }}:</label>
  <input type="text" pattern="[0-9]{2}-[0-9]{3} [^\s]{3,}" class="form-control"
  name="city" title="{{ __('Correct form') }}: 72-320 Trzebiatów"
  value="{{ old('city', Auth::user()->city ?? '') }}" required>
</div>

<div class="form-group">
  <label for="comments">{{ __('Comments') }}:</label>
  <textarea class="form-control" name="comments" rows="5">
    {{ old('comments') }}
  </textarea>
</div>
