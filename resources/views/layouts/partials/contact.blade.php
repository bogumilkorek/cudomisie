<section class="blue" id="contact">

  <div class="container">

    <h1>
      <img src="{{ asset('images/cudomisie-logo-male.png') }}" />
      {{ __('Contact') }}
    </h1>
    <hr>

    <div class="info-card-wrapper">

      <div class="info-card">
        <a class="btn btn-circle">
          <i class="fa fa-male" aria-hidden="true"></i>
        </a>
        <span>Pracownia Cudomisie</span>
      </div>

      <div class="info-card">
        <a class="btn btn-circle">
          <i class="fa fa-map-marker" aria-hidden="true"></i>
        </a>
        <span>ul. Rzemieślnicza 18, 72-320 Trzebiatów</span>
      </div>

      <div class="info-card">
        <a class="btn btn-circle" href="tel:502336103" title="Zadzwoń">
          <i class="fa fa-phone" aria-hidden="true"></i>
        </a>
        <span>502 336 103</span>
      </a>
    </div>

    <div class="info-card">
      <button type="button" class="btn btn-circle" href="mailto:kontakt@cudomisie.pl" title="Wyślij e-mail">
        <i class="fa fa-envelope" aria-hidden="true"></i>
      </button>
      <span>kontakt@cudomisie.pl</span>
    </a>
  </div>

</div>

<h2>
  <i class="fa fa-credit-card" aria-hidden="true"></i> Dane do przelewu:
</h2>
<hr>
<div class="panel panel-default">
  <div class="panel-body">
    <p>
      Tadeusz Pyzia<br />
      PKO BP Oddział w Kołobrzegu<br />
      Nr konta: 21 1020 2821 0000 1702 0022 1242<br />
      Tytuł wpłaty: Proszę podać w tytule numer zamówienia.
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

        <div class="col-xs-6">

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

        <div class="col-xs-6">

          <div class="form-group">
            <textarea class="form-control" id="content" name="content" rows="6" minlength="20"
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
