    <!-- ==================== Footer Start Here ==================== -->
    @php
        $policyPages = getContent('policy_pages.element', false, null, true);
        $socialIcons = getContent('social_icon.element', false, null, true);
        $footer = getContent('footer.content', true);
    @endphp

    <footer class="footer-area section-bg">
        <div class="pt-60 pb-60">
            <div class="container">
                <div class="footer-item__logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ siteLogo() }}" alt="logo" />
                    </a>
                </div>
                <div class="footer-item-wrapper">
                    <div class="footer-item">
                        <p class="footer-item__desc">{{ __(@$footer->data_values->description) }}</p>
                        <ul class="social-list">
                            @foreach ($socialIcons as $social)
                                <li class="social-list__item">
                                    <a href="{{ @$social->data_values->url }}" class="social-list__link flex-center" target="_blank">
                                        @php
                                            echo @$social->data_values->social_icon;
                                        @endphp
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="footer-item">
                        <h6 class="footer-item__title">@lang('Quick Links') </h6>
                        <ul class="footer-menu">
                            <li class="footer-menu__item">
                                <a href="{{ route('home') }}" class="footer-menu__link">@lang('Home')</a>
                            </li>
                            <li class="footer-menu__item">
                                <a href="{{ route('blog') }}" class="footer-menu__link">@lang('Blog')</a>
                            </li>
                            <li class="footer-menu__item">
                                <a href="{{ route('contact') }}" class="footer-menu__link">@lang('Contact')</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-item">
                        <h6 class="footer-item__title">@lang('Competitions')</h6>
                        <ul class="footer-menu">
                            @foreach ($competitions->take(3) as $item)
                                <li class="footer-menu__item">
                                    <a href="{{ route('competiontype.lotteries', $item->slug) }}" class="footer-menu__link">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="footer-item">
                        <h6 class="footer-item__title">@lang('Policy Pages')</h6>
                        <ul class="footer-menu">
                            @foreach ($policyPages as $policy)
                                <li class="footer-menu__item">
                                    <a href="{{ route('policy.pages', $policy->slug) }}" class="footer-menu__link">{{ __($policy->data_values->title) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-footer">
            <div class="bottom-footer__wrapper">
                <p class="bottom-footer-text text-center">
                    @lang('Copyright') &copy; @php echo date('Y') @endphp <a href="{{ route('home') }}" class="text--base">{{ __(gs('site_name')) }}</a> @lang('All Rights Reserved')
                </p>
            </div>
        </div>
    </footer>
