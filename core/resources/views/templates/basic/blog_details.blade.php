@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="blog-detials py-120">
        <div class="container">
            <div class="row gy-5 justify-content-center">
                <div class="col-xl-9 col-lg-8">
                    <div class="blog-details">
                        <div class="blog-details__thumb">
                            <img src="{{ frontendImage('blog', $blog->data_values->image, '970x450') }}" class="fit-image" alt="">
                        </div>
                        <div class="blog-details__content">
                            <span class="blog-item__date-icon">@lang('Published At') {{ showDateTime($blog->created_at, 'd M Y') }}</span>
                            <h3 class="blog-details__title"> {{ @$blog->data_values->title }}</h3>
                            <p class="blog-details__desc">
                                @php echo $blog->data_values->description @endphp
                            </p>
                            <div class="blog-details__share mt-4 d-flex align-items-center flex-wrap gap-2">
                                <h5 class="social-share__title mb-0 me-sm-3 me-1 d-inline-block">@lang('Share This')</h5>
                                <ul class="social-list">
                                    <li class="social-list__item">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                           class="social-list__link flex-center"><i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a href="https://twitter.com/intent/tweet?text={{ __(@$blog->data_values->title) }}%0A{{ url()->current() }}"
                                           class="social-list__link flex-center"> <i class="fa-brands fa-x-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title={{ __(@$blog->data_values->title) }}&amp;summary={{ __(@$blog->data_values->description) }}"
                                           class="social-list__link flex-center"> <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    </li>
                                    <li class="social-list__item">
                                        <a href="http://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&description={{ __(@$blog->data_values->title) }}&media={{ getImage('assets/images/frontend/blog/' . @$blog->data_values->image, '970x490') }}"
                                           class="social-list__link flex-center"> <i class="fab fa-pinterest"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="blog-sidebar-wrapper">
                        <div class="blog-sidebar">
                            <h4 class="blog-sidebar__title"> @lang('Latest Blog') </h4>
                            @foreach ($latestBlogs as $latestBlog)
                                <div class="latest-blog">
                                    <div class="latest-blog__thumb">
                                        <a href="{{ route('blog.details', $latestBlog->slug) }}"> <img src="{{ frontendImage('blog', '/thumb_' . @$latestBlog->data_values->image, '485x225') }}" class="fit-image" alt="img"></a>
                                    </div>
                                    <div class="latest-blog__content">
                                        <h6 class="latest-blog__title"><a href="{{ route('blog.details', $latestBlog->slug) }}"> {{ __(@$latestBlog->data_values->title) }}</a></h6>
                                        <span class="latest-blog__date fs-13">{{ showDateTime($latestBlog->created_at, 'd M Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('fbComment')
    @php echo loadExtension('fb-comment') @endphp
@endpush
