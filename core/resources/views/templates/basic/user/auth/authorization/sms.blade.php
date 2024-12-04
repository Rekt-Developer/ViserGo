@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="py-120">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <form action="{{ route('user.verify.mobile') }}" method="POST" class="submit-form">
                            @csrf
                            <p class="mb-3">@lang('A 6 digit verification code sent to your mobile number') : +{{ showMobileNumber(auth()->user()->mobileNumber) }}</p>
                            @include($activeTemplate . 'partials.verification_code')
                            <button type="submit" class="cmn--btn w-100">@lang('Submit')</button>
                            <div class="mt-3">
                                <p>
                                    @lang('If you don\'t get any code'), <span class="countdown-wrapper">@lang('try again after') <span id="countdown" class="fw-bold">--</span> @lang('seconds')</span> <a
                                       href="{{ route('user.send.verify.code', 'sms') }}" class="try-again-link d-none"> @lang('Try again')</a>
                                </p>
                                <a class="text--base" href="{{ route('user.logout') }}">@lang('Logout')</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var distance = Number("{{ @$user->ver_code_send_at->addMinutes(2)->timestamp - time() }}");
        var x = setInterval(function() {
            distance--;
            document.getElementById("countdown").innerHTML = distance;
            if (distance <= 0) {
                clearInterval(x);
                document.querySelector('.countdown-wrapper').classList.add('d-none');
                document.querySelector('.try-again-link').classList.remove('d-none');
            }
        }, 1000);
        $('#verification-code').on('input', function() {
            var inputLength = $(this).val().length;
            if (inputLength == 6) {
                $(this).addClass('cursor-color');
            } else {
                $(this).removeClass('cursor-color');
            }
        });
    </script>
@endpush

@push('style')
    <style>
        .verification-code-wrapper {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.17);
        }

        .verification-code span {
            background: transparent;
            border: solid 1px #{{ gs('base_color') }}52;
            color: #{{ gs('base_color') }};
        }

        .verification-code input {
            color: #bbaeae !important;
        }

        .verification-code::after {
            background-color: #350b2d;
        }

        .verification-code::after {
            display: none;
        }

        .cursor-color {
            caret-color: transparent;
        }
    </style>
@endpush
