@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="contact-section py-120">
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="verification-code-wrapper">
                    <div class="verification-area">
                        <form action="{{ route('user.password.verify.code') }}" method="POST" class="submit-form">
                            @csrf
                            <p class="mb-3">@lang('A 6 digit verification code sent to your email address') : {{ showEmailAddress($email) }}
                            </p>
                            <input type="hidden" name="email" value="{{ $email }}">

                            @include($activeTemplate . 'partials.verification_code')

                            <button type="submit" class="cmn--btn w-100">@lang('Submit')</button>

                            <p class="mt-3">
                                @lang('Please check including your Junk/Spam Folder. if not found, you can')
                                <a class="text--base" href="{{ route('user.password.request') }}">@lang('Try to send again')</a>
                            </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
@push('script')
    <script>
        (function($) {
            "use strict";
            $('#verification-code').on('input', function() {
                var inputLength = $(this).val().length;
                if (inputLength == 6) {
                    $(this).addClass('cursor-color');
                } else {
                    $(this).removeClass('cursor-color');
                }
            });
        })(jQuery)
    </script>
@endpush
