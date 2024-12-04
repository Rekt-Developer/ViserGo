@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="notice"></div>
        <div class="row gy-4 justify-content-center">
            <div class="col-12">
                <div class="row gy-4 justify-content-center dashboard-widget-wrapper">
                    <div class="col-xxl-3 col-sm-6 col-xsm-6">
                        <a href="{{ route('user.deposit.history') }}" class="dashboard-widget flex-align">
                            <div class="dashboard-widget__icon flex-center">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div class="dashboard-widget__content">
                                <span class="dashboard-widget__text">@lang('Payments')</span>
                                <h4 class="dashboard-widget__number">{{ showAmount($totalDeposit) }}</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-xxl-3 col-sm-6 col-xsm-6">
                        <a href="{{ route('user.transactions') }}" class="dashboard-widget flex-align">
                            <div class="dashboard-widget__icon flex-center">
                                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                            </div>
                            <div class="dashboard-widget__content">
                                <span class="dashboard-widget__text">@lang('Transaction')</span>
                                <h4 class="dashboard-widget__number">{{ $totalTransaction }}</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-xxl-3 col-sm-6 col-xsm-6">
                        <a href="{{ route('user.lottery.purchased') }}" class="dashboard-widget flex-align">
                            <div class="dashboard-widget__icon flex-center">
                                <i class="fa-solid fa-trophy"></i>
                            </div>
                            <div class="dashboard-widget__content">
                                <span class="dashboard-widget__text">@lang('Winning Tickets')</span>
                                <h4 class="dashboard-widget__number">{{ $totalWins }}</h4>
                            </div>
                        </a>
                    </div>
                    <div class="col-xxl-3 col-sm-6 col-xsm-6">
                        <a href="{{ route('user.lottery.purchased') }}" class="dashboard-widget flex-align">
                            <div class="dashboard-widget__icon flex-center">
                                <i class="fa-solid fa-ticket"></i>
                            </div>
                            <div class="dashboard-widget__content">
                                <span class="dashboard-widget__text">@lang('Lottery Buy')</span>
                                <h4 class="dashboard-widget__number">{{ $totalPurchased }}</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            @include($activeTemplate . 'partials.ticket_table', ['lotteries' => $lotteries])
        </div>
    </div>
@endsection
