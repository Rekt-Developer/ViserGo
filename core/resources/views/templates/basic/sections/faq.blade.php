@php
    $faqs = getContent('faq.element');
    $faqContent = getContent('faq.content', true);
@endphp

<section class="faq-section py-120">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title">{{ __(@$faqContent->data_values->heading) }}</h2>
        </div>
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <div class="faq-thumb">
                    <img src="{{ frontendImage('faq', @$faqContent->data_values->image, '635x425') }}" alt="img" />
                </div>
            </div>
            <div class="col-lg-6">
                @foreach ($faqs as $faq)
                    <div class="faq-item">
                        <div class="faq-item__title">
                            <h5 class="title">{{ __(@$faq->data_values->question) }}</h5>
                        </div>
                        <div class="faq-item__content">
                            <p>
                                {{ __(@$faq->data_values->answer) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
