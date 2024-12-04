@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center gy-4">
            <div class="col-md-10">
                <div class="card custom--card">
                    <div class="card-body">
                        <div class="row gy-4 align-items-center justify-content-center">
                            <div class="col-md-5 col-lg-4">
                                <div class="thumb details-thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{ getImage(getFilePath('raffle') . '/' . @$lottery->slider_images[0], getFileSize('raffle')) }})">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 col-lg-8 ps-lg-5">
                                <h3 class="mb-3">{{ __($pageTitle) }}</h3>
                                <P class="details-list">@lang('Total Price') : <span class="text">{{ showAmount($totalPrice) }}</span> </P>
                                <p class="details-list">@lang('Your Choosen Tickets:')</p>
                                <div class="ticket-no-wrapper">
                                    <ul class="ticket-no-list">
                                        @foreach ($pickedTickets as $pickedTicket)
                                            <li class="ticket-no-item"> {{ $pickedTicket }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if (!empty($allWinningTickets))
                                    <h6 class="mt-4">@lang('Your Winning Tickets:')</h6>
                                    <div class="ticket-no-wrapper">
                                        <ul class="ticket-no-list">
                                            @foreach ($allWinningTickets as $winningTicket)
                                                <li class="ticket-no-item win"> {{ $winningTicket }} </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-5 mb-4">
                            <div class="col-12">
                                <h4 class="mb-3">@lang('Your Price Giving:')</h4>
                                <div>
                                    @php
                                        echo $lottery->price_giving;
                                    @endphp
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('style')
    <style>
        .details-list {
            font-size: 1rem;
            font-family: var(--heading-font);
            font-weight: 600;
        }

        .details-list:not(:last-of-type) {
            margin-bottom: 8px;
        }

        .ticket-no-list {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .ticket-no-wrapper {
            margin-top: 12px;
        }

        .details-list .text {
            color: hsl(var(--white) / .6)
        }

        .details-thumb {
            margin: 0;
        }

        .details-thumb .profilePicPreview {
            border: 0;
            height: 200px;
        }

        .ticket-no-item {
            line-height: 1;
            padding: 10px 12px;
            background-color: hsl(var(--white) / .1);
            border-radius: 4px;
            border: 1px solid hsl(var(--white) / .1);
            color: hsl(var(--white));
            font-weight: 600;
            font-family: var(--heading-font);
        }

        .ticket-no-item.win {
            background: linear-gradient(0deg, var(--secondColor) 40%, var(--color) 110%);
            border-color: transparent;
        }
    </style>
@endpush
