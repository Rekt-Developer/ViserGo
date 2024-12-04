@php
    $loginContent = getContent('login.content', true);
@endphp
@extends($activeTemplate . 'layouts.app')
@section('app_content')
    <section class="account">
        <div class="account-inner">
            <div class="account-inner__left">
                <div class="account-form-wrapper">
                    <div class="text-center">
                        <a href="{{ route('home') }}" class="account-form__logo">
                            <img src="{{ siteLogo() }} " alt="" />
                        </a>
                        <h4 class="account-form__title mt-3">{{ __($loginContent->data_values->heading) }}</h4>
                        <p class="account-form__text">{{ __($loginContent->data_values->subheading) }}</p>
                    </div>
                    @include($activeTemplate . 'partials.social_login')

                    <form method="POST" action="{{ route('user.login') }}" class="verify-gcaptcha">
                        @csrf
                        <div class="form-group">
                            <label class="form--label">@lang('Username or Email')</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control form--control" required>
                        </div>

                        <div class="form-group">
                            <label for="password" class="form--label">@lang('Password')</label>
                            <input id="password" type="password" class="form-control form--control" name="password" required>
                        </div>

                        <x-captcha />

                        <div class="d-flex justify-content-between align-items-center flex-wrap form-group">
                            <div class="form--check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">@lang('Remember Me')</label>
                            </div>
                            <a href="{{ route('user.password.request') }}" class="text--base">@lang('Forgot Password?')</a>
                        </div>
                        <button type="submit" id="recaptcha" class="cmn--btn w-100"> @lang('Login')</button>
                    </form>
                    @if (gs('registration'))
                        <div class="mt-3 text-center">
                            <p>@lang('Don\'t Have Any Account?') <a href="{{ route('user.register') }}" class="text--base">@lang('Register Now')</a></p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="account-inner__right">
                <div class="account-thumb">
                    <img src="{{ frontendImage('login', @$loginContent->data_values->image, '800x510') }}" alt="img" />
                </div>
            </div>
        </div>
    </section>
@endsection
