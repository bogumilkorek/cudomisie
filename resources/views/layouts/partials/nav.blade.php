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
        <a href="{{ url('/') }}">
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
        aria-haspopup="true" aria-expanded="false" href="{{ route('user.products.index') }}">
        {{ __('Products') }} <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        @foreach ($categories as $category)
          @if(!$category->children->isEmpty())
            <li>
              <a href="{{ route('user.categories.show', $category->slug) }}">
                {{ $category->title }}
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                @foreach ($category->children as $child)
                  <li>
                    <a href="{{ route('user.categories.show', $child->slug) }}">
                      {{ $child->title }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </li>
          @else
            <li>
              <a href="{{ route('user.categories.show', $category->slug) }}">
                {{ $category->title }}
              </a>
            </li>
          @endif
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
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" role="button"
      aria-haspopup="true" aria-expanded="false">
      <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge" id="cart-items-counter">{{ Request::session()->get('cart.counter') ?? '' }}</span>
    </a>
    <ul class="dropdown-menu">
      @foreach($items['products'] as $product)
        <li class="nav-cart-item">
          <a>
            <div>
              <img src="{{ $product->images->first()->thumbnail_url }}">
            </div>
            <div>
              {{ $product->title }}
              <!--<br />({{ $items['quantities'][$product->slug] . ' ' . __('pcs.') }})-->
            </div>
            <div>
              <i class="fa fa-times-circle cart-remove" data-slug="{{ $product->slug }}" aria-hidden="true" title="{{ __('Remove') }}"></i>
            </div>
          </a>
        </li>
      @endforeach
      <li class="text-center"><a href={{ route('cart.show') }}>{{ __('Show cart') }}</a></li>
    </ul>
  </li>
  <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" role="button"
    aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-search" aria-hidden="true"></i>
  </a>
  <ul class="dropdown-menu text-center">
    <li class="nav-search">
      <form method="GET" class="navbar-form navbar-left" action="{{ route('user.search') }}">
        <div class="input-group">
          <input type="text" class="form-control" name="q" placeholder="{{ __('Search') }}" required minlength="5">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </span>
        </div>
      </form>
    </li>
  </ul>
</li>
<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" role="button"
  aria-haspopup="true" aria-expanded="false">
  <i class="fa fa-user-circle" aria-hidden="true"></i>
</a>
<ul class="dropdown-menu text-center">
  @if (Auth::guest())
    <li>
      <a href="{{ route('login') }}">
        {{ __('Login') }}
      </a>
    </li>
  @else
    @if(Auth::user()->admin)
      <li>
        <a href="{{ url('/admin') }}">
          {{ __('Admin panel') }}
        </a>
      </li>
    @else
      <li>
        <a href="{{ route('user.orders.index') }}">
          {{ __('My orders') }}
        </a>
      </li>
      <li>
        <a href="{{ route('user.profile.show') }}">
          {{ __('Show profile') }}
        </a>
      </li>
    @endif
    <li><a href="{{ route('logout') }}"
      onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">
      {{ __('Logout') }}
    </a>
  </li>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
  </form>
@endif
</ul>
</ul>
</div>

<!-- /.navbar-collapse -->

<!-- /.container -->
</nav>
