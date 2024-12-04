@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <div class="contact-section py-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <div class="card custom--card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.data.submit') }}">
                                @csrf
                                <div class="row">
                                    <div class="form-group">
                                        <label class="form--label">@lang('Username')</label>
                                        <input type="text" class="form-control form--control checkUser" name="username" value="{{ old('username') }}" required>
                                        <small class="text--danger usernameExist"></small>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Country')</label>
                                            <select name="country" class="form-control form--control select2" required>
                                                @foreach ($countries as $key => $country)
                                                    <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}" data-code="{{ $key }}">{{ __($country->country) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form--label">@lang('Mobile')</label>
                                            <div class="input-group ">
                                                <span class="input-group-text mobile-code">

                                                </span>
                                                <input type="hidden" name="mobile_code">
                                                <input type="hidden" name="country_code">
                                                <input type="number" name="mobile" value="{{ old('mobile') }}" class="form-control form--control checkUser" required>
                                            </div>
                                            <small class="text--danger mobileExist"></small>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form--label">@lang('Address')</label>
                                        <input type="text" class="form-control form--control" name="address" value="{{ old('address') }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form--label">@lang('State')</label>
                                        <input type="text" class="form-control form--control" name="state" value="{{ old('state') }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form--label">@lang('Zip Code')</label>
                                        <input type="text" class="form-control form--control" name="zip" value="{{ old('zip') }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label class="form--label">@lang('City')</label>
                                        <input type="text" class="form-control form--control" name="city" value="{{ old('city') }}">
                                    </div>
                                </div>
                                <button type="submit" class="cmn--btn w-100">@lang('Submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('style')
    <style>
        .responsive-filter-card {
            background-color: hsl(var(--section-bg));
            border: 0;
        }

        .select2-container,
        .select2-container .selection {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            border-width: 1px !important;
            border-color: hsl(var(--white) / 0.2) !important;
            background-color: transparent !important;
            padding: 11px 24px !important;
        }

        .select2-container--focus .select2-selection--single,
        .select2-container--open .select2-selection--single {
            outline: none;
            box-shadow: none;
            border-color: hsl(var(--base)) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: hsl(var(--white)) !important;
            padding-left: 0px;
            padding-right: 0px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 16px !important;
        }

        .select2-dropdown {
            background-color: #350b2d;
        }

        .select2-results__option.select2-results__option--selected,
        .select2-results__option--selectable,
        .select2-container--default .select2-results__option--disabled {
            border-bottom-color: hsl(var(--white) / 0.2);
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            color: hsl(var(--base)) !important;
            background-color: hsl(var(--base) / 0.15) !important;
        }

        .select2-results__option.select2-results__option--selected,
        .select2-results__option--highlighted.select2-results__option--selectable.select2-results__option--selected {
            color: hsl(var(--black)) !important;
            background-color: hsl(var(--base)) !important;
        }
    </style>
@endpush


@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush


@push('script')
    <script>
        "use strict";
        (function($) {

            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('.select2').select2();

            $('select[name=country]').on('change', function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
                var value = $('[name=mobile]').val();
                var name = 'mobile';
                checkUser(value, name);
            });

            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));


            $('.checkUser').on('focusout', function(e) {
                var value = $(this).val();
                var name = $(this).attr('name')
                checkUser(value, name);
            });

            function checkUser(value, name) {
                var url = '{{ route('user.checkUser') }}';
                var token = '{{ csrf_token() }}';

                if (name == 'mobile') {
                    var mobile = `${value}`;
                    var data = {
                        mobile: mobile,
                        mobile_code: $('.mobile-code').text().substr(1),
                        _token: token
                    }
                }
                if (name == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.field} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            }
        })(jQuery);
    </script>
@endpush
