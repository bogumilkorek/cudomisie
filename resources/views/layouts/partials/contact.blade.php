<section class="blue" id="contact">

  <div class="container">

    <h1>
      {{ __('Contact') }}
    </h1>
    <hr>

    <div class="info-card-wrapper">

      <div class="info-card">
        <a class="btn btn-circle">
          <i class="fa fa-male" aria-hidden="true"></i>
        </a>
        <span>{{ env('MAIL_FROM_NAME') }}</span>
      </div>

      <div class="info-card">
        <a class="btn btn-circle">
          <i class="fa fa-map-marker" aria-hidden="true"></i>
        </a>
        <span>{{ env('SELLER_ADDRESS') }}, {{ env('SELLER_CITY') }}</span>
      </div>

      <div class="info-card">
        <a class="btn btn-circle" href="tel:{{ str_replace(' ', '', env('SELLER_PHONE')) }}" title="Zadzwoń">
          <i class="fa fa-phone" aria-hidden="true"></i>
        </a>
        <span>{{ env('SELLER_PHONE') }}</span>
    </div>

    <div class="info-card">
      <a class="btn btn-circle" href="{{ env('MAIL_FROM_ADDRESS') }}" title="Wyślij e-mail">
        <i class="fa fa-envelope" aria-hidden="true"></i>
      </a>
      <span>{{ env('MAIL_FROM_ADDRESS') }}</span>
  </div>

</div>

<h2>
  <i class="fa fa-credit-card" aria-hidden="true"></i> {{ __('Payment data') }}:
</h2>
<hr>
<div class="panel panel-default">
  <div class="panel-body">
    <p>
      {{ env('SELLER_NAME') }}<br />
      {{ env('SELLER_BANK_NAME') }}<br />
      {{ __('On account') }}: {{ env('SELLER_BANK_ACCOUNT') }}<br />
      {{ __('Payment title') }}: {{ __('Order number') }}
    </p>
  </div>
</div>

<br />

<h2>
  <i class="fa fa-pencil" aria-hidden="true"></i> {{ __('Contact form') }}:
</h2>
<hr>
<div class="panel panel-default">
  <div class="panel-body">
    <form method="POST" action="{{ route('email.contactForm') }}">
      {{ csrf_field() }}
      <div class="row">

        <div class="col-md-6 col-xs-12">

          <div class="form-group">
            <input type="text" pattern="[^\s]{3,} [^\s]{3,}" class="form-control" name="name"
            value="{{ old('name') }}" placeholder="{{ __('Name') }}" required>
          </div>

          <div class="form-group">
            <input type="email" class="form-control" name="email"
            value="{{ old('email') }}" placeholder="{{ __('E-mail') }}" required>
          </div>

          <div class="form-group">
            <input type="text" pattern="((\+|00)[0-9]{2})?[0-9]{9}" class="form-control"
            name="phone" title="{{ __('Phone number must be 9 digits') }}."
            value="{{ old('phone') }}" placeholder="{{ __('Phone') }}" required>
          </div>

        </div>

        <div class="col-md-6 col-xs-12">

          <div class="form-group">
            <textarea class="form-control" id="messageContent" name="messageContent" rows="6" minlength="20"
            placeholder="{{ __('Message') }}" required>{{ old('content') }}</textarea>
          </div>

        </div>

      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-dashed"
        data-loading-text="<i class='fa fa-refresh fa-spin'></i>
        {{ __('Loading') }}"><i class='fa fa-paper-plane-o'></i> {{ __('Send') }}
      </button>
    </div>

  </form>
</div>
</div>

</div>

</section>
