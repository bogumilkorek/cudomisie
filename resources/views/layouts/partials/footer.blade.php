<section class="footer">

  <div class="container text-center">

    <i class="fa fa-copyright" aria-hidden="true"></i> {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved') }}.
    <br />

    <div class="footer-nav-wrapper">

      <a class="btn btn-dashed" href="{{ route('user.pages.show', str_slug(__('Homepage'))) }}">
        {{ __('Start') }}
      </a>

      <a class="btn btn-dashed" href="{{ route('user.blogPosts.index') }}">
        {{ __('Blog') }}
      </a>

      <a class="btn btn-dashed" href="{{ route('user.pages.show', str_slug(__('About us'))) }}">
        {{ __('About us') }}
      </a>

      <a class="btn btn-dashed" href="{{ route('user.pages.show', str_slug(__('Shipment'))) }}">
        {{ __('Shipment') }}
      </a>

      <a class="btn btn-dashed" href="{{ route('user.pages.show', str_slug(__('Terms of use'))) }}">
        {{ __('Terms of use') }}
      </a>

      <a class="btn btn-dashed" href="{{ route('user.pages.show', str_slug(__('Feedback'))) }}">
        {{ __('Feedback') }}
      </a>

      <a class="btn btn-dashed" href="{{ route('user.pages.show', str_slug(__('Contact'))) }}">
        {{ __('Contact') }}
      </a>

    </div>

    <form method="GET" action="{{ route('user.search') }}">
      <div class="input-group col-md-2 col-md-offset-5">
        <input type="text" class="form-control" name="q" placeholder="{{ __('Search') }}" required minlength="5">
        <span class="input-group-btn">
          <button class="btn btn-secondary btn-min" type="submit">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </span>
      </div>
    </form>

    @include('layouts.partials.social')

    <img src="{{ asset("images/cudomisie-mis.png") }}" />

  </div>

</section>
