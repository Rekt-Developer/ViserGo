@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="competition-section py-120">
        <div class="container">
            <div class="row gy-4">
                @forelse ($competionTypeLotteries->lotteries as $item)
                    <div class="col-xl-3 col-md-6">
                        <div class="competition-item">
                            <a href="{{ route('lottery.details', [@$item->id, @$item->slug]) }}" class="competition-item__thumb">
                                <img src="{{ getImage(getFilePath('raffle') . '/thumb_' . @$item->slider_images[0], getFileThumbSize('raffle')) }}" alt="">
                            </a>
                            <span class="competition-item__status">
                                @lang('Left') {{ @$item->num_of_available_tickets }}
                            </span>
                            <div class="competition-item__content">
                                <h5 class="competition-item__title">
                                    <a href="{{ route('lottery.details', [@$item->id, @$item->slug]) }}" class="competition-item__link"> {{ @$item->name }} </a>
                                </h5>
                                <div class="countdown-item countdown" data-Date="{{ @$item->draw_date, 'd-m-Y H:i:s' }}">
                                    <div class="remaining-time">
                                        <div class="remaining-time running">
                                            <ul class="remaining-time__content d-flex countdown__menu">
                                                <li class="box countdown__list"><span class="days"></span> <span class="box__text"> @lang('Days') </span> </li>
                                                <li class="box"><span class="hours"></span> <span class="box__text">@lang('Hours') </span> </li>
                                                <li class="box"><span class="minutes"></span> <span class="box__text">@lang('Minutes') </span></li>
                                                <li class="box"><span class="seconds"></span><span class="box__text">@lang('second') </span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="competittion-item__btn">
                                    <a href="{{ route('lottery.details', [@$item->id, @$item->slug]) }}" class="cmn--btn w-100">@lang('Buy Tickets') ({{ showAmount(@$item->price, exceptZeros: true) }})</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-message-area">
                        <img src="{{ getImage($activeTemplateTrue . 'images/empty.png') }}" alt="img">
                        <h6 class="text--danger">@lang('No raffles found yet!')</h6>
                    </div>
                @endforelse

                @if ($competionTypeLotteries->lotteries->hasPages())
                    {{ paginateLinks($competionTypeLotteries->lotteries) }}
                @endif
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .remaining-time__content {
            width: 100%;
        }
    </style>
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/multi-countdown.js') }}"></script>
@endpush
