@extends('admin.layouts.app')
@section('panel')
    <form action="{{ route('admin.lottery.store', @$lottery->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group ">
                                            <label>@lang('Name')</label>
                                            <input class="form-control" name="name" required type="text" value="{{ old('name', @$lottery->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('Competition Type')</label>
                                            <select class="form-control select2" name="competition_id" required>
                                                <option disabled selected value="">@lang('Select One')</option>
                                                @foreach ($competitions as $competition)
                                                    <option value="{{ $competition->id }}" @selected(old('competition_id', @$lottery->competition_id) == $competition->id)>
                                                        {{ __($competition->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>@lang('Price')</label>
                                            <div class="input-group">
                                                <input class="form-control" name="price" required type="number" step="any" value="{{ old('price', getAmount(@$lottery->price)) }}">
                                                <span class="input-group-text">{{ __(gs('cur_text')) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>@lang('Number of Tickets')
                                                <i class="las la-info-circle text--primary" title="@lang('Changes cannot be made once submitted.')"></i>
                                            </label>
                                            <input class="form-control" name="num_of_tickets" required type="number" value="{{ old('num_of_tickets', @$lottery->num_of_tickets) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>@lang('Max Buy Per Person')</label>
                                            <input class="form-control" name="max_buy" required type="number" value="{{ old('max_buy', @$lottery->max_buy) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>@lang('Ticket Starts From')
                                                <i class="las la-info-circle text--primary" title="@lang('Changes cannot be made once submitted.')"></i>
                                            </label>
                                            <input class="form-control" name="starting_from" required type="number" value="{{ old('starting_from', @$lottery->starting_from) }}" {{ @$lottery->id ? 'readonly' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>@lang('Segments')</label>
                                            <input class="form-control" name="segments" required type="number" value="{{ old('segments', @$lottery->segments) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label>@lang('Instant Choose Variation')></label>
                                            <input class = "form-control" name = "instant_choose_variation" required type = "text" value="{{ old('instant_choose_variation', @$lottery->instant_choose_variation) }}">
                                            <code>@lang('To select instant tickets. For example: 4,7,10')</code>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('Number of Winner Ticket')</label>
                                            <input class="form-control" name="num_of_winning_tickets" required type="number" value="{{ old('num_of_winning_tickets', @$lottery->num_of_winning_tickets) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang('Draw Date')</label>
                                            <input autocomplete="off" class="datepicker-here form-control" data-language="en" data-position='bottom left' data-range="false" name="draw_date"
                                                   value="{{ old('draw_date', showDateTime(@$lottery->draw_date)) }}">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Description')</label>
                                    <textarea name="description" class="form-control nicEdit" rows="10" required>
                                        {{ old('description', @$lottery->description) }}
                                    </textarea>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('Price Giving Info')</label>
                                    <textarea name="price_giving" class="form-control nicEdit" rows="10" required>
                                        {{ old('price_giving', @$lottery->price_giving) }}
                                    </textarea>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label>@lang('Images')</label>
                                    <code>
                                        <small class="fs-12"><i class="las la-info-circle"></i>
                                            @lang('Supported image will be resized into') {{ getFileSize('raffle') }} @lang('px'),
                                            @lang('Max upload 6 files')
                                        </small>
                                    </code>
                                    <div class="input-images pb-3"></div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn--primary h-45 w-100 mt-3" type="submit">@lang('Submit')</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('admin.lottery.index') }}" />
@endpush


@push('style-lib')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/image-uploader.min.css') }}">
@endpush

@push('script-lib')
    <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/image-uploader.min.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict"

            $('.datepicker-here').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                startDate: moment().startOf('hour'),
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD hh:mm A',
                    cancelLabel: 'Clear'
                }

            });

            var existingDate = $('input[name="draw_date"]').val();
            if (existingDate != '-') {
                var formattedDate = moment(existingDate, 'YYYY-MM-DD hh:mm A').format('YYYY-MM-DD hh:mm A');
                $('input[name="draw_date"]').data('daterangepicker').setStartDate(formattedDate);
                $('input[name="draw_date"]').val(formattedDate);
            }

            $('.datepicker-here').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD hh:mm A'));
            });

            $('.datepicker-here').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });


        })(jQuery)
    </script>

    <script>
        (function($) {
            "use strict";

            @if (isset($images))
                let preloaded = @json($images);
            @else
                let preloaded = [];
            @endif

            $('.input-images').imageUploader({
                preloaded: preloaded,
                imagesInputName: 'images',
                preloadedInputName: 'old',
                maxSize: 2 * 1024 * 1024,
                maxFiles: 6
            });
        })(jQuery);
    </script>
@endpush
