<section class="footer">

  <div class="container text-center">

    <i class="fa fa-copyright" aria-hidden="true"></i> 2016 cudomisie.pl</a>
    &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
    <a href="http://bk-it.pl" target="_blank">
      <i class="fa fa-cog fa-spin"></i>  Realizacja: BK-IT
    </a>
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

    <div class="input-group col-md-2 col-md-offset-5">
      <input type="text" class="form-control" placeholder="{{ __('Search') }}" required>
      <span class="input-group-btn">
        <button class="btn btn-secondary" type="button">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </span>
    </div>

    <div class="footer-icons-wrapper">

      <a class="btn btn-circle">
        <i class="fa fa-level-up" aria-hidden="true"></i>
      </a>

      <a class="btn btn-circle">
        <i class="fa fa-facebook" aria-hidden="true"></i>
      </a>

      <a class="btn btn-circle">
        <i class="fa fa-twitter" aria-hidden="true"></i>
      </a>

      <a class="btn btn-circle">
        <i class="fa fa-google-plus" aria-hidden="true"></i>
      </a>

      <a class="btn btn-circle">
        <i class="fa fa-flickr" aria-hidden="true"></i>
      </a>

    </div>

    <img src="{{ asset("images/cudomisie-mis.png") }}" />

  </div>

</section>
