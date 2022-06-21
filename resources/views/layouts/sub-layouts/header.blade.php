<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="brand" href="/">Apple Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a @isActive('index') aria-current="page"
                           href="{{ route('index') }}">@lang('main.menu.main')</a>
                    </li>
                    <li class="nav-item">
                        <a @isActive('categories') href="{{ route('categories') }}">@lang('main.menu.categories')</a>
                    </li>
                    <li class="nav-item">
                        <a @isActive('products*') href="{{ route('products') }}">@lang('main.menu.all_products')</a>
                    </li>
                    <li class="nav-item">
                        <a @isActive('#bot') href="#bot">@lang('main.menu.contacts')</a>
                    </li>
                    <li class="nav-item">
                        <a @isActive('#about') href="#about">@lang('main.menu.about_us')</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @if(!\Illuminate\Support\Facades\Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page"
                               href="{{ route('login') }}">@lang('main.menu.login')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page"
                               href="{{ route('register') }}">@lang('main.menu.registry')</a>
                        </li>
                    @else
                        @if(\Illuminate\Support\Facades\Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page"
                                   href="{{ route('products.index') }}">@lang('main.menu.admin_panel')</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a @isActive('personal-area*') class="nav-link" aria-current="page"
                               href="{{ route('personal-area.index') }}">@lang('main.menu.personal_area')</a>
                        </li>
                        <li class="nav-item">
                            <a @isActive('user.orders') class="nav-link" aria-current="page"
                               href="{{ route('user.orders') }}">@lang('main.menu.orders')</a>
                        </li>
                        <li class="nav-item" style="margin-right: 10px">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-secondary">@lang('main.menu.logout')</button>
                            </form>
                        </li>
                    @endif
                    <li>
                        <select name="locale" onchange="window.location.href=this.options[this.selectedIndex].value"
                                class="form-select bg-secondary currency" aria-label="Default select example" style="width: 70px">
                            @foreach(['ru', 'en'] as $locale)
                                <option @if(session('locale') == $locale) selected
                                        @endif value="{{ route('locale', $locale) }}"><a
                                        href="{{ route('locale', $locale) }}">{{ $locale }}</a>
                                </option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <select name="currency" onchange="window.location.href=this.options[this.selectedIndex].value"
                                class="form-select bg-secondary currency" aria-label="Default select example">
                            @foreach($currencies as $currency)
                                <option @if(session('currency') == $currency->code) selected
                                        @endif value="{{ route('currency', $currency->code ) }}"><a
                                        href="{{ route('currency', $currency->code) }}">{{ $currency->symbol }}</a>
                                </option>
                            @endforeach
                        </select>
                    </li>
                    <li class="nav-item">
                        <a @isActive('cart.index') id="cart" aria-current="page" href="{{ route('cart.index') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                 class="bi bi-cart2" viewBox="0 0 16 16">
                                <path
                                    d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
