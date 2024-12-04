<form class="search-box-wrapper mb-3">
    <h4 class="search-box-wrapper-title">@lang('My Raffle Tickets')</h4>
    <div class="search-box">
        <input type="search" name="search" class="form--control" value="{{ request()->search }}" placeholder="@lang('Search by lottery')">
        <button type="button" class="search-box__button"><i class="fas fa-search"></i></button>
    </div>
</form>

<div class="dashboard-table ">
    <table class="table table--responsive--xl">
        <thead>
            <tr>
                <th> @lang('Lottery Name') </th>
                <th> @lang('Price') </th>
                <th> @lang('Live draw') </th>
                <th> @lang('Drawn Status') </th>
                <th> @lang('Win Status') </th>
                <th> @lang('Action') </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($lotteries as $lottery)
                <tr>
                    <td> {{ $lottery->name }} </td>
                    <td> {{ showAmount($lottery->price) }} </td>
                    <td> {{ showDateTime($lottery->draw_date) }} </td>
                    <td>
                        @php
                            echo $lottery->drawnBadge;
                        @endphp
                    </td>
                    <td>
                        @php
                            echo $lottery->win_status;
                        @endphp
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('user.lottery.purchased.detail', $lottery->slug) }}" class="btn btn--base btn--sm">
                                <i class="las la-desktop"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if (method_exists($lotteries, 'links'))
        @if ($lotteries->hasPages())
            {{ paginateLinks($lotteries) }}
        @endif
    @endif
</div>
