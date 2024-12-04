@php
    $latestLotteries = App\Models\Lottery::active()->live()->orderBy('draw_date', 'asc')->take(8)->get();
    $competitionContent = getContent('competition.content', true);
@endphp

<div class="competition-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section-heading__title">{{ __(@$competitionContent->data_values->heading) }}</h2>
                </div>
            </div>
        </div>
        <div class="row gy-4 justify-content-center">
            @foreach ($latestLotteries as $item)
                <div class="col-xl-3 col-md-6">
                    <div class="competition-item">
                        <a href="{{ route('lottery.details', [@$item->id, @$item->slug]) }}" class="competition-item__thumb">
                            <img src="{{ getImage(getFilePath('raffle') . '/thumb_' . @$item->slider_images[0], getFileSize('raffle')) }}" alt="" />
                        </a>
                        <span class="competition-item__status"> @lang('Left') {{ @$item->num_of_available_tickets }}</span>
                        <div class="competition-item__content">
                            <h5 class="competition-item__title">
                                <a href="{{ route('lottery.details', [@$item->id, @$item->slug]) }}" class="competition-item__link">
                                    {{ @$item->name }}
                                </a>
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
                                <a href="{{ route('lottery.details', [@$item->id, @$item->slug]) }}" class="cmn--btn w-100">@lang('Buy Tickets') ({{ showAmount(@$item->price) }})</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

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
