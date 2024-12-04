@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 bg--transparent shadow-none">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two bg-white">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Price')</th>
                                    <th>@lang('Draw date')</th>
                                    <th>@lang('Total Wins')</th>
                                    <th>@lang('Payment')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lotteriesByUser as $lottery)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <img alt="" class="thumb" src="{{ getImage(getFilePath('raffle') . '/' . @$lottery->slider_images[0], getFileSize('raffle')) }}">
                                                <a href="{{ route('admin.lottery.add', $lottery->id) }}">
                                                    <span class="fw-bold ms-2">{{ __(@$lottery->name) }}</span>
                                                </a>
                                            </div>

                                        </td>
                                        <td>{{ showAmount(@$lottery->price) }} </td>
                                        <td>{{ showDateTime(@$lottery->draw_date) }}</td>
                                        <td> {{ count(json_decode($lottery->user_winned)) }}</td>
                                        <td>
                                            @if ($lottery->payment == Status::PAYMENT_SUCCESS)
                                                <span class="badge badge--success">@lang('Done')</span>
                                            @else
                                                <span class="badge badge--warning">@lang('Pending')</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                echo $lottery->statusBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <button class="btn btn-sm btn-outline--primary ticketView" data-pick-tickets="{{ $lottery->user_picked }}" data-win-tickets="{{ $lottery->user_winned }}">
                                                    <i class="la la-eye"></i> @lang('View')
                                                </button>
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
                    </div>
                </div>
                @if (@$lotteriesByUser->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks(@$lotteriesByUser) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

    <div id="ticketModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Tickets')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="fw-semibold mb-2">@lang('Choosen Tickets')</h6>
                    <ul class="ticketsInfo"></ul>
                    <h6 class="fw-semibold my-2">@lang('Winning Tickets')</h6>
                    <ul class="winInfo"></ul>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Name / Competition" />
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $(document).on('click', '.ticketView', function() {
                var modal = $('#ticketModal');
                let dataPicked = $(this).data('pick-tickets');
                let dataWinned = $(this).data('win-tickets');

                $('.ticketsInfo').empty();
                $('.winInfo').empty();

                $.each(dataPicked, function(index, pickedTicket) {
                    $('.ticketsInfo').append(' <li class="btn btn-sm btn--dark ticketBtn">' +
                        pickedTicket + '</li>')
                })

                $.each(dataWinned, function(index, winningTicket) {
                    $('.winInfo').append(' <li class="btn btn-sm btn--primary ticketBtn">' +
                        winningTicket + '</li>')
                })


                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
