<div class="dashboard-header__inner flex-between">
    <div class="dashboard-header__left">
        <h4 class="dashboard-header__grettings mb-0 d-none d-lg-block">
            @lang('Hello ') {{ auth()->user()->fullName }}
        </h4>
        <div class="d-lg-none dashboard-header-left-inner">
            <div class="dashboard-body__bar">
                <span class="dashboard-body__bar-icon"><i class="las la-bars"></i></span>
            </div>
            <a class="dashboard-header__logo" href="{{ route('home') }}"><img src="{{ siteLogo() }}" alt="img" /></a>
        </div>
    </div>
    <div class="dashboard-header__right flex-align">
        <div class="user-info">
            <div class="user-info__right">

                <div class="user-info__button">
                    <div class="user-info__thumb">
                        <img src="{{ getImage(getFilePath('userProfile') . '/thumb_' . auth()->user()->image, getFileThumbSize('userProfile')) }}" alt="" />
                    </div>
                    <div class="user-info__profile">
                        <p class="user-info__name">{{ auth()->user()->username }}</p>
                    </div>
                </div>
            </div>
            <ul class="user-info-dropdown">
                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="{{ route('user.profile.setting') }}">
                        <span class="icon"><i class="las la-user"></i></span>
                        <span class="text"> @lang('Profile Setting') </span>
                    </a>
                </li>
                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="{{ route('user.change.password') }}">
                        <span class="icon"><i class="las la-lock"></i></span>
                        <span class="text"> @lang('Change Password') </span>
                    </a>
                </li>
                <li class="user-info-dropdown__item">
                    <a class="user-info-dropdown__link" href="{{ route('user.logout') }}">
                        <span class="icon"><i class="las la-sign-out-alt"></i></span>
                        <span class="text"> @lang('Logout') </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
