<nav class="navbar navbar-default" role="navigation">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <a href="{{ route('user.pages.show', str_slug(__('Homepage'))) }}">
            <i class="fa fa-home" aria-hidden="true"></i>
          </a>
        </li>
        <li>
          <a href="{{ route('user.blogPosts.index') }}">
            {{ __('Blog') }}
          </a>
        </li>
        <li>
          <a href="{{ route('user.pages.show', str_slug(__('About us'))) }}">
            {{ __('About us') }}
          </a>
        </li>
        <li class="dropdown">
               <a class="dropdown-toggle" data-toggle="dropdown" role="button"
               aria-haspopup="true" aria-expanded="false">
                 {{ __('Products') }} <span class="caret"></span>
               </a>
               <ul class="dropdown-menu">
                  @foreach ($categories as $category)
                   <li>
                     <a href="{{ route('user.categories.show', $category->slug) }}">
                       {{ $category->title }}
                     </a>
                   </li>
                  @endforeach
               </ul>
             </li>
        <li>
          <a href="{{ route('user.pages.show', str_slug(__('Shipment'))) }}">
            {{ __('Shipment') }}
          </a>
        </li>
        <li>
          <a href="{{ route('user.pages.show', str_slug(__('Terms of use'))) }}">
            {{ __('Terms of use') }}
          </a>
        </li>
        <li>
          <a href="{{ route('user.pages.show', str_slug(__('Feedback'))) }}">
            {{ __('Feedback') }}
          </a>
        </li>
        <li>
          <a href="{{ route('user.pages.show', str_slug(__('Contact'))) }}">
            {{ __('Contact') }}
          </a>
        </li>
        <li>
          <a href="{{ route('cart.show') }}">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-search" aria-hidden="true"></i>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-user-circle" aria-hidden="true"></i>
          </a>
        </li>
      </ul>
    </div>

    <!-- /.navbar-collapse -->

  <!-- /.container -->
</nav>
