@php
    $topWinnersContent = getContent('top_winners.content', true);
    $topWinners = App\Models\Winner::selectRaw('user_id, COUNT(ticket_number) as total_winning_tickets')->groupBy('user_id')->with('user')->orderBy('total_winning_tickets', 'desc')->take(6)->get();
@endphp

<section class="top-section py-120 bg_img" style="background:url({{ asset($activeTemplateTrue . 'images/top/bg.png') }}) center">
    <div class="container">
        <div class="row justify-content-center gy-4">
            <div class="col-xl-5">
                <div class="lastest-winner__info">
                    <span class="icon">
                        <i class="las la-check-circle"></i>
                    </span>
                    <h2 class="info-title"> {{ __(@$topWinnersContent->data_values->heading_one) }} </h2>
                    <p class="info-desc">{{ __(@$topWinnersContent->data_values->subheading) }}</p>
                </div>
            </div>

            <div class="col-xl-7">
                <div class="top-winner-wrapper">
                    <div class="icon">
                        <i class="las la-certificate"></i>
                    </div>
                    <h2 class="title">{{ __(@$topWinnersContent->data_values->heading_two) }}</h2>
                    <div class="top-investor-slider">
                        @forelse ($topWinners as $topWinner)
                            <div class="winner-card">
                                <div class="investor-item">
                                    <div class="investor-item__thumb">
                                        <img src="{{ getImage(getFilePath('userProfile') . '/' . @$topWinner->user->image, '60x60', true) }}" alt="top" />
                                    </div>
                                    <div class="investor-item__content">
                                        <h6 class="name">{{ __($topWinner->user->fullname) }}</h6>
                                        <p class="amount">{{ @$topWinner->total_winning_tickets }} @lang('Tickets') </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="cart-item text-center">
                                {{ __($emptyMessage) }}
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
