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
                                    <th>@lang('Status')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($competitions as $competition)
                                    <tr>
                                        <td>
                                            <span>{{ __($competition->name) }}</span>
                                        </td>
                                        <td>
                                            @php
                                                echo $competition->statusBadge;
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="button--group">
                                                <a class="btn btn-sm btn-outline--primary editBtn cuModalBtn" data-modal_title="@lang('Update Competition')" data-resource="{{ $competition }}">
                                                    <i class="las la-pen"></i>
                                                    @lang('Edit')
                                                </a>

                                                @if ($competition->status)
                                                    <button class="btn btn-sm btn-outline--danger confirmationBtn" data-action="{{ route('admin.competition.status', $competition->id) }}" data-question="@lang('Are you sure to disable this competition')?"><i
                                                           class="la la-eye-slash"></i> @lang('Disable')</button>
                                                @else
                                                    <button class="btn btn-sm btn-outline--success confirmationBtn" data-action="{{ route('admin.competition.status', $competition->id) }}"
                                                            data-question="@lang('Are you sure to enable this competition')?"><i class="la la-eye"></i> @lang('Enable')</button>
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
                @if ($competitions->hasPages())
                    <div class="card-footer py-4">
                        {{ paginateLinks($lotteries) }}
                    </div>
                @endif
            </div><!-- card end -->
        </div>
    </div>

    <x-confirmation-modal />

    <div class="modal fade" id="cuModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Close">
                        <i class="las la-times"></i>
                    </button>
                </div>
                <form action="{{ route('admin.competition.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>@lang('Name')</label>
                            <input class="form-control" name="name" type="text" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn--primary w-100 h-45" type="submit">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    <x-search-form placeholder="Search by Name" />
    <button type="button" class="btn btn-outline--primary cuModalBtn" data-modal_title="@lang('Add Competition')"><i class="las la-plus"></i>@lang('Add New')</button>
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/cu-modal.js') }}"></script>
@endpush
