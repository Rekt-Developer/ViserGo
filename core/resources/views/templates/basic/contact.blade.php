@php
    $contact = getContent('contact_us.content', true);
@endphp

@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="contact-section py-120">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="contact-item">
                        <div class="contact-item__shape"></div>
                        <span class="contact-item__icon">
                            <i class="las la-envelope"></i>
                        </span>
                        <h4 class="contact-item__title">@lang('Email Address') </h4>
                        <p class="contact-item__text">
                            <a href="mailto:{{ @$contact->data_values->email_address }}" class="contact-item__link">{{ @$contact->data_values->email_address }}</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="contact-item">
                        <div class="contact-item__shape"></div>
                        <span class="contact-item__icon">
                            <i class="las la-phone-volume"></i>
                        </span>
                        <h4 class="contact-item__title">@lang('Contact Number')</h4>
                        <p class="contact-item__text">
                            <a href="tel:{{ @$contact->data_values->contact_number }}" class="contact-item__link">{{ @$contact->data_values->contact_number }}</a>
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="contact-item">
                        <div class="contact-item__shape"></div>
                        <span class="contact-item__icon">
                            <i class="las la-map-marker-alt"></i>
                        </span>
                        <h4 class="contact-item__title">@lang('Contact Address')</h4>
                        <p class="contact-item__text">
                            {{ @$contact->data_values->contact_details }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="contact-bottom">
                <div class="row gy-4 justify-content-center">
                    <div class="col-xl-6 col-lg-5 col-md-8 pe-lg-5">
                        <div class="contact-bottom__thumb">
                            <img src="{{ frontendImage('contact_us', @$contact->data_values->image, '575x620') }}" alt="" />
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-7 ps-lg-5">
                        <div class="contact-form">
                            <h2 class="contact-form__title">{{ @$contact->data_values->title }}</h2>

                            <form method="post" action="" class="verify-gcaptcha">
                                @csrf
                                <div class="form-group">
                                    <label class="form--label label-two">@lang('Name')</label>
                                    <input name="name" type="text" class="form-control form--control" value="{{ old('name', @$user->fullname) }}" @if ($user && $user->profile_complete) readonly @endif required>
                                </div>
                                <div class="form-group">
                                    <label class="form--label label-two">@lang('Email')</label>
                                    <input name="email" type="email" class="form-control form--control" value="{{ old('email', @$user->email) }}" @if ($user) readonly @endif required>
                                </div>
                                <div class="form-group">
                                    <label class="form--label label-two">@lang('Subject')</label>
                                    <input name="subject" type="text" class="form-control form--control" value="{{ old('subject') }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form--label label-two">@lang('Message')</label>
                                    <textarea name="message" wrap="off" class="form-control form--control" required>{{ old('message') }}</textarea>
                                </div>
                                <x-captcha />
                                <button type="submit" class="btn btn--base btn--lg">@lang('Submit')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($sections)
        @foreach (json_decode($sections) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
