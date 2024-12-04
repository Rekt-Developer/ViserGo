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
                                    <th>@lang('Winner')</th>
                                    <th>@lang('Raffle Name')</th>
                                    <th>@lang('Ticket NO')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($winners as $winner)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{ __(@$winner->user->fullname) }}</span>
                                            <br>
                                            <span class="small">
                                                <a
                                                   href="{{ route('admin.users.detail', @$winner->user->id) }}"><span>@</span>{{ @$winner->user->username }}</a>
                                            </span>
                                        </td>
                                        <td>
                                            <span>{{ __(@$winner->lottery->name) }}</span>
                                        </td>
                                        <td><span>{{ $winner->ticket_number }}</span></td>
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
                @if ($winners->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($winners) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection



@push('breadcrumb-plugins')
    <x-search-form />
@endpush
