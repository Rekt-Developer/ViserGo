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
                                    <th>@lang('Drawn At')</th>
                                    <th>@lang('Tickets')</th>
                                    <th>@lang('Sold | Available')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Is Drawn')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lotteries as $lottery)
                                    <tr>
                                        <td>
                                            <div class="user">
                                                <div class="thumb"><img src="{{ getImage(getFilePath('raffle') . '/' . @$lottery->slider_images[0], getFileSize('raffle')) }}" alt="img" class="plugin_bg"></div>
                                                <span class="name">{{ __($lottery->name) }}</span>
                                            </div>
                                        </td>
                                        <td>{{ showAmount(@$lottery->price) }} </td>
                                        <td>{{ showDateTime(@$lottery->draw_date) }}</td>
                                        <td>{{ @$lottery->num_of_tickets }}</td>
                                        <td>
                                            @lang('Sold:') {{ @$lottery->num_of_tickets - @$lottery->num_of_available_tickets }} <br>
                                            @lang('Available:') {{ @$lottery->num_of_available_tickets }}
                                        </td>
                                        <td>
                                            @php
                                                echo $lottery->statusBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                echo $lottery->drawnBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                @if ($lottery->is_drawn)
                                                    <button class="btn btn-sm btn-outline--success showWinBtn" type="button" data-winning_tickets="{{ json_encode($lottery->winning_tickets) }}"><i
                                                           class="la la-trophy"></i> @lang('Winner')
                                                    </button>
                                                @else
                                                    <a class="btn btn-sm btn-outline--primary" href="{{ route('admin.lottery.add', @$lottery->id) }}"><i class="la la-pencil-alt"></i> @lang('Edit')</a>
                                                    @if (@$lottery->status)
                                                        <button class="btn btn-sm btn-outline--danger confirmationBtn" type="button" data-action="{{ route('admin.lottery.status', @$lottery->id) }}" data-question="@lang('Are you sure to disable this lottery')?"><i
                                                               class="la la-eye-slash"></i> @lang('Disable')</button>
                                                    @else
                                                        <button class="btn btn-sm btn-outline--success confirmationBtn" type="button" data-action="{{ route('admin.lottery.status', @$lottery->id) }}" data-question="@lang('Are you sure to enable this lottery')?"><i
                                                               class="la la-eye"></i> @lang('Enable')</button>
                                                    @endif
                                                @endif
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
                @if (@$lotteries->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks(@$lotteries) }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div id="showWinModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Winner Ticket Number')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                @csrf
                <div class="modal-body">
                    <ul class="ticketsInfo"></ul>
                    <div class="d-flex flex-wrap gap-3 show-result">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-confirmation-modal />
@endsection

@push('breadcrumb-plugins')
    <x-search-form placeholder="Search by Name" />
    <a class="btn btn-outline--primary" href="{{ route('admin.lottery.add') }}"><i class="las la-plus"></i>@lang('Add New')</a>
@endpush

@push('style')
    <style>
        .ticket-number {
            background-color: #28c76f;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.showWinBtn').on('click', function() {
                let modal = $("#showWinModal");
                let winningTickets = $(this).data('winning_tickets');
                let html = ``;
                $.each(winningTickets, function(index, winningTicket) {
                    html += `<li class="btn btn-sm btn--primary ticketBtn">${winningTicket}</li>`
                });
                modal.find('.show-result').html(html);
                modal.modal('show');
            });
        })(jQuery)
    </script>
@endpush
