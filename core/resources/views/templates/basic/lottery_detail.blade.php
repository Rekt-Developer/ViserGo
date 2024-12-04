@extends($activeTemplate . 'layouts.frontend')

@section('content')
    <div class="py-120 overflow-hidden">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="competition-details__wrapper">
                        @foreach (@$lottery->slider_images as $item)
                            <div class="competition-details__item">
                                <img src="{{ getImage(getFilePath('raffle') . '/' . $item, getFileSize('raffle')) }}" alt="" />
                            </div>
                        @endforeach
                    </div>
                    <div class="competition-details__gallery">
                        @foreach (@$lottery->slider_images as $item)
                            <div>
                                <div class="competition-gallery__item">
                                    <img src="{{ getImage(getFilePath('raffle') . '/thumb_' . $item, getFileSize('raffle')) }}" alt="" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <div class="competition-details__right">
                        <h2 class="competition-details__right-title">
                            {{ $lottery->name }}
                        </h2>
                        <h3 class="competition-details__right-title text--base">
                            {{ showAmount($lottery->price) }}
                        </h3>

                        <a href="#buysection" class="cmn--btn">@lang('Buy Tickets')</a>
                        <h5 class="tickets-wrapper__title">@lang('Enter Your Tickets')</h5>
                        <div class="competition-details__quantity d-flex">
                            <form action="#">
                                <p class="qty">
                                    <button class="qtyminus" aria-hidden="true">&minus;</button>
                                    <input type="number" name="qty" id="qty" min="1" step="1" value="1" />
                                    <button class="qtyplus" aria-hidden="true">&plus;</button>
                                </p>
                            </form>
                            <div class="competition-details__button {{ $percentage == 100 ? 'd-none' : '' }}">
                                <button type="submit" class="btn cmn--btn lottery-book-any">
                                    @lang('Lucky Dip')
                                </button>
                            </div>
                        </div>

                        <div class="remaining-time">
                            <span class="title"> @lang('Live Drawn:') </span>
                            <div class="countdown-item countdown" data-Date="{{ @$lottery->draw_date, 'd-m-Y H:i:s' }}">
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



                        </div>
                        <div class="competition-details__progressbar">
                            <div class="progressbar-count">
                                <span class="count-start"> {{ $lottery->num_of_tickets - $lottery->num_of_available_tickets }} </span>
                                <span class="count-notice"> @lang('Total Sold') </span>
                                <span class="count-end"> {{ $lottery->num_of_tickets }} </span>
                            </div>
                            <div class="progress custom--progress">
                                <div class="progress-bar bg--base" role="progressbar" aria-label="Success example" style="width: {{ $percentage }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="remaining-count">{{ $lottery->num_of_available_tickets }} @lang('Tickets remaining')</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="buysection">
                    <div class="competition-details__tab">
                        <ul class="nav nav-pills custom--tab tab-two" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-history-tab" data-bs-toggle="pill" data-bs-target="#pills-history" type="button" role="tab" aria-controls="pills-history" aria-selected="false">
                                    @lang('Products')
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link " id="pills-descrip-tab" data-bs-toggle="pill" data-bs-target="#pills-descrip" type="button" role="tab" aria-controls="pills-descrip" aria-selected="true">
                                    @lang('Description')
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link " id="pills-descrip-tab" data-bs-toggle="pill" data-bs-target="#pills-price-giving" type="button" role="tab" aria-controls="pills-descrip"
                                        aria-selected="true">
                                    @lang('Price Giving')
                                </button>
                            </li>

                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-history" role="tabpanel" aria-labelledby="pills-history-tab" tabindex="0">
                                <div class="tickets-wrapper">
                                    <div id="cart">
                                        <button type="submit" class="d-block ms-auto">
                                            <a class="btn cmn--btn " href="{{ route('cart') }}">@lang('Go to cart')</a>
                                        </button>
                                    </div>

                                    <div class="competition-details__dip {{ empty($newInstChooseTickets) ? 'd-none' : '' }}">
                                        <p class="title">@lang('Choose an Instant Lucky Dip:')</p>
                                        <div class="dip-wrapper">
                                            @foreach ($newInstChooseTickets as $item)
                                                <button class="btn-item segment-ticket active">
                                                    {{ $item }} @lang('Tickets')
                                                </button>
                                            @endforeach
                                        </div>

                                        <div class="text-center another-login">
                                            <span class="another-login__text">@lang('Or')</span>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="title mb-2">@lang('Choose manually:')</p>

                                        <div class="competition-details__ticket-range">
                                            @foreach ($ticketsDataSets as $key => $item)
                                                <button class="ticket-btn {{ $key == 0 ? 'ticket-btn-active' : '' }}" data-segment="{{ $key }}">{{ $item['startfrom'] }} - {{ $item['endat'] }}</button>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="ticket-number-wrapper">
                                        @foreach ($ticketsDataSets as $key => $segment)
                                            <ul class="ticket-number-list ticket-number-list-choose mb-3 {{ $key == 0 ? '' : 'd-none' }}" id="segment-{{ $key }}">
                                                @foreach ($segment['values'] as $ticket)
                                                    @php
                                                        $ticketArray = [intval($ticket)];
                                                        $isAvailable = checkPickedLottery($lottery, $ticketArray);
                                                        $isAvailable = $isAvailable ? 'click' : 'active';
                                                        $isSelected = checkCartLottery($cartTickets, $ticketArray);
                                                        $class = $isSelected ? 'selected' : $isAvailable;
                                                    @endphp
                                                    <li class="ticket-number-item  {{ $class }}">{{ $ticket }} </li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade " id="pills-descrip" role="tabpanel" aria-labelledby="pills-descrip-tab" tabindex="0">
                                <div class="description-list">
                                    @php
                                        echo $lottery->description;
                                    @endphp
                                </div>
                            </div>

                            <div class="tab-pane fade " id="pills-price-giving" role="tabpanel" aria-labelledby="pills-price-giving-tab" tabindex="0">
                                <div class="description-list">
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

    <div class="modal fade custom--modal fade-in-scale" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="ticketModalLabel">
                        <span class="title">@lang('LUCKY')</span>
                        <span class="title-style">@lang('DIP')</span>
                    </h1>
                </div>
                <div class="modal-body text-center">
                    <h5 class="modal-body__title">@lang('Tickets added in your cart')</h5>
                    <span class="modal-body__text">@lang('Your entry numbers are') </span>
                    <div class="ticket-number-wrapper">
                        <ul class="ticket-number-list justify-content-center ticket-number-list-modal"></ul>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <a href="{{ route('cart') }}" class="cmn--btn">@lang('Go to cart')</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        .remaining-time__content {
            width: 100%;
        }



        #cart {
            display: none;
        }

        .custom--modal .modal-header {
            justify-content: center;
        }

        .custom--modal .modal-footer {
            justify-content: center;
        }
    </style>
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/multi-countdown.js') }}"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            $('.ticket-btn').on('click', function() {
                var segmentKey = $(this).data('segment');
                $('.ticket-btn').removeClass('ticket-btn-active')
                $(this).addClass('ticket-btn-active');
                $('.ticket-number-list-choose').addClass('d-none');
                $('#segment-' + segmentKey).removeClass('d-none');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // _______________ Any Number of Tickets _______________
            $('.lottery-book-any').on('click', function(e) {
                e.preventDefault();

                const quantity = $('#qty').val();
                const id = Number(`{{ $lottery->id }}`);
                const url = "{{ route('lottery.book.any') }}";

                bookLotteryTickets(quantity, id, url)
                    .then(response => {
                        if (response.error) {
                            notify("error", response.error);
                            return;
                        }
                        updateCartCount();
                        updateTicketNumberList(response.data.randAvailableTickets);
                        updateLotteryDetailInfo(response);
                    })
                    .catch(error => {
                        notify("error", "An error occurred in booking any lottery tickets");
                    });

            });

            // _______________ Segment Tickets _______________
            $('.segment-ticket').on('click', function() {
                var segmentTicketValue = $.trim($(this).text());

                const quantity = segmentTicketValue.split(" ")[0];
                const id = Number(`{{ $lottery->id }}`);
                const url = "{{ route('lottery.book.segmentwise') }}";

                bookLotteryTickets(quantity, id, url)
                    .then(response => {
                        if (response.error) {
                            notify("error", response.error);
                            return;
                        }

                        updateCartCount();
                        updateTicketNumberList(response.data.randAvailableTickets);
                        updateLotteryDetailInfo(response);
                    })
                    .catch(error => {
                        notify("error", "An error occurred in booking segment lottery tickets");
                    });

            })

            // _______________ Single Ticket _______________
            $(document).on('click', '.ticket-number-item.click', function() {

                if (!$(this).hasClass('active')) {

                    $(this).addClass('selected');
                    $(this).removeClass('click');

                    if ($('.ticket-number-item.selected').length > 0) {
                        $('#cart').fadeIn(200);
                    } else {
                        $('#cart').fadeOut(200);
                    }
                }

                const ticketNumber = $(this).text().trim();
                const quantity = 1;
                const id = Number(`{{ $lottery->id }}`);
                const url = "{{ route('lottery.book.single', ':ticketNumber') }}".replace(':ticketNumber', ticketNumber);

                bookLotteryTickets(quantity, id, url)
                    .then(response => {
                        if (response.error) {
                            $(this).removeClass('selected');
                            $(this).addClass('click');
                            notify("error", response.error);
                            return;
                        }

                        const singleTicket = true

                        updateCartCount()
                        updateLotteryDetailInfo(response, singleTicket);
                    })
                    .catch(error => {
                        notify("error", "An error occurred in booking single lottery ticket");
                    });
            })


            async function bookLotteryTickets(quantity, id, url) {

                const response = await $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity,
                        id,
                    },
                });
                return response;
            }

            async function updateCartCount() {
                try {
                    const response = await $.ajax({
                        url: "{{ route('cart.count') }}",
                        method: "GET",
                    });

                    if (response.cartItemsCount !== undefined) {
                        $('.cart-number').text(response.cartItemsCount);
                    } else {
                        notify("error", "Cart cannot be updated");
                    }
                } catch (error) {
                    notify("error", "An error occurred while updating the cart count");
                }
            }

            function updateLotteryDetailInfo(response, singleTicket = false) {

                if (!singleTicket) {
                    $('.ticket-number-list-modal').empty();
                    $.each(response.data.randAvailableTickets, function(index, value) {
                        $('.ticket-number-list-modal').append(`<li class="ticket-number-item">${value}</li>`);
                    });
                    $('#ticketModal').modal('show');
                }
            }


            function updateTicketNumberList(bookedTickets) {
                $('.ticket-number-item').each(function() {
                    var ticketNumber = $.trim($(this).text());
                    if (bookedTickets.includes(parseInt(ticketNumber))) {
                        $(this).removeClass('click');
                        $(this).addClass('selected');
                    }
                })
            }

        });
    </script>
@endpush
