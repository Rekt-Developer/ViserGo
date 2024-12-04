@php
    $blogContent = getContent('blog.content', true);
    $blogElements = getContent('blog.element', false, 3, false);
@endphp

<section class="blog py-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section-heading__title"> {{ __(@$blogContent->data_values->heading) }} </h2>
                    <p class="section-heading__desc">{{ __(@$blogContent->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($blogElements as $item)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-item">
                        <div class="blog-item__thumb">
                            <a href="{{ route('blog.details', $item->slug) }}" class="blog-item__thumb-link">
                                <img src="{{ frontendImage('blog', 'thumb_' . @$item->data_values->image, '485x225') }}" class="fit-image" alt="img">
                            </a>
                        </div>
                        <div class="blog-item__content">
                            <ul class="text-list flex-align gap-3">
                                <li class="text-list__item fs-14 badge badge--base"> @lang('Published At') </li>
                                <li class="text-list__item fs-14"> {{ showDateTime($item->created_at, 'd M Y') }} </li>
                            </ul>
                            <h5 class="blog-item__title">
                                <a href="{{ route('blog.details', $item->slug) }}" class="blog-item__title-link border-effect">
                                    {{ __(@$item->data_values->title) }}
                                </a>
                            </h5>
                            <p class="blog-item__desc">
                                @php
                                    echo strLimit(strip_tags(@$item->data_values->description), 90);
                                @endphp
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
