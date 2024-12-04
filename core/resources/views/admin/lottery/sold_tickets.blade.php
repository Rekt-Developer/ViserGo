@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('User')</th>
                                    <th>@lang('Raffle')</th>
                                    <th>@lang('Quantity')</th>
                                    <th>@lang('Ticket No')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tickets as $ticket)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ __(@$ticket->user->fullname) }}</span>
                                            <br>
                                            <span class="small">
                                                <a
                                                   href="{{ route('admin.users.detail', @$ticket->user->id) }}"><span>@</span>{{ @$ticket->user->username }}</a>
                                            </span>
                                        </td>
                                        <td>
                                            <span>{{ __(@$ticket->lottery->name) }}</span>
                                        </td>
                                        <td><span>{{ $ticket->quantity }}</span></td>
                                        <td>{{ implode(', ', @$ticket->choosen_tickets ?? []) }}</td>
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
                @if ($tickets->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($tickets) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-search-form />
@endpush
