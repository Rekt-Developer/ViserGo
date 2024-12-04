<div class="sidebar-menu flex-between">
    <div class="sidebar-menu__inner">
        <span class="sidebar-menu__close d-lg-none"><i class="las la-times"></i></span>
        <div class="sidebar-logo">
            <a href="{{ route('home') }}" class="sidebar-logo__link"><img src="{{ siteLogo() }}" alt="img" /></a>
        </div>

        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.home') }}" class="sidebar-menu-list__link {{ menuActive('user.home') }}">
                    <span class="icon"><i class="las la-home"></i></span>
                    <span class="text">@lang('Dashboard')</span>
                </a>
            </li>

            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.lottery.purchased') }}" class="sidebar-menu-list__link {{ menuActive(['user.lottery.purchased', 'user.lottery.purchased.detail']) }}">
                    <span class="icon"><i class="las la-gift"></i></span>
                    <span class="text"> @lang('Raffle Tickets') </span>
                </a>
            </li>

            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.deposit.history') }}" class="sidebar-menu-list__link {{ menuActive('user.deposit.history') }}">
                    <span class="icon"><i class="las la-money-bill-wave"></i></span>
                    <span class="text">@lang('Payment history')</span>
                </a>
            </li>

            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.transactions') }}" class="sidebar-menu-list__link {{ menuActive('user.transactions') }}">
                    <span class="icon"><i class="las la-exchange-alt"></i></span>
                    <span class="text"> @lang('Transaction') </span>
                </a>
            </li>

            <li class="sidebar-menu-list__item has-dropdown {{ menuActive(['ticket.*']) }}">
                <a href="javascript:void(0)" class="sidebar-menu-list__link {{ menuActive(['ticket.*']) }}">
                    <span class="icon"><i class="las la-ticket-alt"></i></span>
                    <span class="text"> @lang('Support Ticket') </span>
                </a>
                <div class="sidebar-submenu">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item">
                            <a href="{{ route('ticket.open') }}" class="sidebar-submenu-list__link {{ menuActive('ticket.open') }}">
                                <span class="text"> @lang('Open New Ticket') </span>
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item">
                            <a href="{{ route('ticket.index') }}" class="sidebar-submenu-list__link {{ menuActive(['ticket.index', 'ticket.view']) }}">
                                <span class="text"> @lang('My Tickets') </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.profile.setting') }}" class="sidebar-menu-list__link {{ menuActive('user.profile.setting') }}">
                    <span class="icon"><i class="las la-user"></i></span>
                    <span class="text"> @lang('Profile Setting') </span>
                </a>
            </li>
            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.change.password') }}" class="sidebar-menu-list__link {{ menuActive('user.change.password') }}">
                    <span class="icon"><i class="las la-lock"></i></span>
                    <span class="text"> @lang('Change Password') </span>
                </a>
            </li>
            <li class="sidebar-menu-list__item">
                <a href="{{ route('user.logout') }}" class="sidebar-menu-list__link">
                    <span class="icon"><i class="las la-sign-out-alt"></i></span>
                    <span class="text"> @lang('Logout') </span>
                </a>
            </li>
        </ul>
    </div>
</div>
