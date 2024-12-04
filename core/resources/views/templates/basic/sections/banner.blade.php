@php
    $bannerContent = getContent('banner.content', true);
@endphp

<section class="banner-section bg_img overflow-hidden">
    <div class="container">
        <div class="banner-wrapper d-flex flex-wrap align-items-center row">
            <div class="col-xl-7">
                <div class="banner-content">
                    <h1 class="banner-content__title">{{ __(@$bannerContent->data_values->heading) }}</h1>
                    <p class="banner-content__subtitle">{{ __(@$bannerContent->data_values->subheading) }}</p>
                    <div class="button-wrapper">
                        <a href="{{ url(@$bannerContent->data_values->button_one_url) }}" class="cmn--btn btn--lg">
                            {{ __(@$bannerContent->data_values->button_one_name) }}
                        </a>
                        @guest
                            <a href="{{ url(@$bannerContent->data_values->button_two_url) }}" class="btn btn-outline--base btn--lg">
                                {{ __(@$bannerContent->data_values->button_two_name) }}
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="banner-thumb">
                    <img src="{{ frontendImage('banner', @$bannerContent->data_values->image, '750x590') }}" alt="banner" />
                </div>
            </div>
        </div>
    </div>
</section>
