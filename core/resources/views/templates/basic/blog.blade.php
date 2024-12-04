@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="blog py-120">
        <div class="container">
            <div class="row gy-4 justify-content-center">
                @forelse ($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-item">
                            <div class="blog-item__thumb">
                                <a href="{{ route('blog.details', $blog->slug) }}" class="blog-item__thumb-link">
                                    <img src="{{ frontendImage('blog', 'thumb_' . @$blog->data_values->image, '485x225') }}" class="fit-image" alt="img">
                                </a>
                            </div>
                            <div class="blog-item__content">
                                <ul class="text-list flex-align gap-3">
                                    <li class="text-list__item fs-14 badge badge--base"> @lang('Published At') </li>
                                    <li class="text-list__item fs-14"> {{ showDateTime($blog->created_at, 'd M Y') }} </li>
                                </ul>
                                <h5 class="blog-item__title">
                                    <a href="{{ route('blog.details', $blog->slug) }}" class="blog-item__title-link border-effect">
                                        {{ __(@$blog->data_values->title) }}
                                    </a>
                                </h5>
                                <p class="blog-item__desc">
                                    @php
                                        echo strLimit(strip_tags(@$blog->data_values->description), 90);
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        <i class="far fa-2x fa-frown text-muted"></i>
                        <h5 class="mt-2 text-muted">@lang('No blogs found yet!')</h5>
                    </div>
                @endforelse

                @if ($blogs->hasPages())
                    {{ paginateLinks($blogs) }}
                @endif
            </div>
        </div>
    </section>

    @if ($sections)
        @foreach (json_decode($sections) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection
