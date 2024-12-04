<header class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-xl navbar-light">
            <a class="navbar-brand logo" href="{{ route('home') }}">
                <img src="{{ siteLogo() }}" alt="" />
            </a>
            <div class="d-xl-none d-block header-cart-btn">
                <div class="header-cart">
                    <a href="{{ route('cart') }}" class="link">
                        <i class="las la-shopping-cart"></i>
                    </a>
                    <span class="cart-number">{{ itemCount() }}</span>
                </div>
            </div>

            <button class="navbar-toggler header-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span id="hiddenNav"><i class="las la-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-menu m-auto align-items-xl-center">
                    <li class="nav-item {{ menuActive('home') }}">
                        <a class="nav-link" href="{{ route('home') }}">@lang('Home')</a>
                    </li>
                    @foreach ($pages as $k => $data)
                        <li class="nav-item {{ menuActive('pages', null, $data->slug) }}"><a href="{{ route('pages', [$data->slug]) }}" class="nav-link">{{ __($data->name) }}</a></li>
                    @endforeach
                    <li class="nav-item dropdown {{ menuActive(['competiontype.lotteries', 'competion.drawn.lotteries']) }}">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @lang('Competitions')
                            <span class="nav-item__icon">
                                <i class="las la-angle-down"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($competitions as $item)
                                @php
                                    $isActive = route('competiontype.lotteries', [$item->slug]) == request()->url() ? 'active' : '';
                                @endphp
                                <li class="dropdown-menu__list">
                                    <a class="dropdown-item dropdown-menu__link {{ $isActive }}" href="{{ route('competiontype.lotteries', $item->slug) }}">
                                        {{ $item->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item {{ menuActive('winners') }}"><a class="nav-link" href="{{ route('winners') }}">@lang('Winners')</a></li>
                    <li class="nav-item {{ menuActive('blog') }}"><a class="nav-link" href="{{ route('blog') }}">@lang('Blog')</a></li>
                    <li class="nav-item {{ menuActive('contact') }}"><a class="nav-link" href="{{ route('contact') }}">@lang('Contact')</a></li>
                    <li class="d-block d-xl-none mt-4">
                        <div class="top-button d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <ul>
                                @auth
                                    <li><a href="{{ route('user.home') }}" class="btn btn--md cmn--btn"> @lang('Dashboard') </a></li>
                                @else
                                    <li><a href="{{ route('user.login') }}" class="btn btn--md cmn--btn"> @lang('Login') </a></li>
                                @endauth
                            </ul>
                            @include($activeTemplate . 'partials.language')
                        </div>
                    </li>
                </ul>
            </div>
            <div class="d-xl-block d-none">
                <div class="d-flex align-items-center gap-3 header-cart-btn">
                    <div class="header-cart">
                        <a href="{{ route('cart') }}" class="link">
                            <i class="las la-shopping-cart"></i>
                        </a>
                        <span class="cart-number">{{ itemCount() }}</span>
                    </div>
                    <div class="top-button  d-flex flex-wrap justify-content-between align-items-center gap-3">
                        @include($activeTemplate . 'partials.language')
                        <ul>
                            @auth
                                <li><a href="{{ route('user.home') }}" class="btn cmn--btn"> @lang('Dashbord') </a></li>
                            @else
                                <li><a href="{{ route('user.login') }}" class="btn cmn--btn"> @lang('Login') </a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
