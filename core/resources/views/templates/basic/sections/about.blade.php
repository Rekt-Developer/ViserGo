@php
    $aboutContent = getContent('about.content', true);
    $aboutElements = getContent('about.element', false, null, true);
@endphp

<div class="about-section py-120">
    <div class="shape"></div>
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-lg-6 pe-lg-5">
                <div class="about-thumb">
                    <img src="{{ frontendImage('about', @$aboutContent->data_values->image, '600x355') }}" alt="image">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-item__wrapper">
                    <div class="section-heading style-left">
                        <h2 class="section-heading__title"> {{ __(@$aboutContent->data_values->heading) }} </h2>
                    </div>

                    @foreach ($aboutElements as $item)
                        <div class="about-item">
                            <div class="about-item__thumb">
                                <img src="{{ frontendImage('about', @$item->data_values->image, '80x80') }}" alt="">
                            </div>
                            <div class="about-item__content">
                                <h5 class="about-item__title"> {{ __(@$item->data_values->title) }} </h5>
                                <p class="about-item__desc">{{ __(@$item->data_values->subtitle) }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
