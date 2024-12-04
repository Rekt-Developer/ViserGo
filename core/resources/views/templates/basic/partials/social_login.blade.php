@php
    $text = isset($register) ? 'Register' : 'Login';
@endphp
<div class="social-login-wrapper">
    @if (@gs('socialite_credentials')->google->status == Status::ENABLE)
        <div class="social-login-item">
            <a href="{{ route('user.social.login', 'google') }}" class="social-login-link">
                <span class="icon">
                    <img src="{{ asset($activeTemplateTrue . 'images/google.svg') }}" alt="Google">
                </span> @lang('Google')
            </a>
        </div>
    @endif
    @if (@gs('socialite_credentials')->facebook->status == Status::ENABLE)
        <div class="social-login-item">
            <a href="{{ route('user.social.login', 'facebook') }}" class="social-login-link">
                <span class="icon">
                    <img src="{{ asset($activeTemplateTrue . 'images/facebook.svg') }}" alt="Facebook">
                </span> @lang('Facebook')
            </a>
        </div>
    @endif
    @if (@gs('socialite_credentials')->linkedin->status == Status::ENABLE)
        <div class="social-login-item">
            <a href="{{ route('user.social.login', 'linkedin') }}" class="social-login-link">
                <span class="icon">
                    <img src="{{ asset($activeTemplateTrue . 'images/linkdin.svg') }}" alt="Linkedin">
                </span> @lang('Linkedin')
            </a>
        </div>
    @endif
</div>

@if (@gs('socialite_credentials')->linkedin->status || @gs('socialite_credentials')->facebook->status == Status::ENABLE || @gs('socialite_credentials')->google->status == Status::ENABLE)
    <div class="text-center another-login">
        <span class="another-login__text">@lang('OR')</span>
    </div>
@endif
