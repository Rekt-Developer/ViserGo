@php
    $testimonialElements = getContent('testimonial.element', false, null, true);
    $testimonialContent = getContent('testimonial.content', true);
@endphp
<section class="testimonials py-120 section-bg">
    <div class="container">
        <div class="section-heading">
            <h2 class="section-heading__title">{{ __(@$testimonialContent->data_values->heading) }}</h2>
            <p class="section-heading__desc">
                {{ __(@$testimonialContent->data_values->subheading) }}
            </p>
        </div>
        <div class="testimonial-slider">
            @foreach ($testimonialElements as $item)
                <div class="testimonails-card">
                    <div class="testimonial-item">
                        <div class="testimonial-item__content">
                            <div class="testimonial-item__info">
                                <div class="testimonial-item__thumb">
                                    <img src="{{ frontendImage('testimonial', @$item->data_values->image, '60x60') }}" class="fit-image" alt="img" />
                                </div>
                                <div class="testimonial-item__details">
                                    <h5 class="testimonial-item__name">
                                        {{ __(@$item->data_values->name) }}
                                    </h5>
                                    <span class="testimonial-item__designation">
                                        {{ __(@$item->data_values->designation) }}
                                    </span>
                                </div>
                            </div>
                            <div class="testimonial-item__rating">
                                @php
                                    $ratings = @$item->data_values->rating;
                                @endphp
                                <ul class="rating-list">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i > $ratings)
                                            <li class="rating-list__item">
                                                <i class="fa-regular fa-star"></i>
                                            </li>
                                        @else
                                            <li class="rating-list__item">
                                                <i class="fas fa-star"></i>
                                            </li>
                                        @endif
                                    @endfor
                                </ul>
                            </div>
                        </div>
                        <p class="testimonial-item__desc">
                            {{ __(@$item->data_values->comment) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
