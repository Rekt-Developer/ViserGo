@extends($activeTemplate . 'layouts.app')

@section('app_content')
    <div class="dashboard position-relative">
        <div class="dashboard__inner flex-wrap">

            @include($activeTemplate . 'partials.sidebar')

            <div class="dashboard__right">

                <div class="dashboard-header">
                    @include($activeTemplate . 'partials.master_header')
                </div>

                <div class="dashboard-body">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
@endpush

@push('style')
    <style>
        .responsive-filter-card {
            background-color: hsl(var(--section-bg));
            border: 0;
        }

        .select2-container,
        .select2-container .selection {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            border-width: 1px !important;
            border-color: hsl(var(--white) / 0.2) !important;
            background-color: transparent !important;
            padding: 11px 24px !important;
        }

        .select2-container--focus .select2-selection--single,
        .select2-container--open .select2-selection--single {
            outline: none;
            box-shadow: none;
            border-color: hsl(var(--base)) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: hsl(var(--white)) !important;
            padding-left: 0px;
            padding-right: 0px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 16px !important;
        }

        .select2-dropdown {
            background-color: #350b2d;
        }

        .select2-results__option.select2-results__option--selected,
        .select2-results__option--selectable,
        .select2-container--default .select2-results__option--disabled {
            border-bottom-color: hsl(var(--white) / 0.2);
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            color: hsl(var(--base)) !important;
            background-color: hsl(var(--base) / 0.15) !important;
        }

        .select2-results__option.select2-results__option--selected,
        .select2-results__option--highlighted.select2-results__option--selectable.select2-results__option--selected {
            color: hsl(var(--black)) !important;
            background-color: hsl(var(--base)) !important;
        }
    </style>
@endpush


@push('script-lib')
    <script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
@endpush

@push('script')
    <script>
        (function($) {
            "use strict";

            function formatState(state) {
                if (!state.id) return state.text;
                let gatewayData = $(state.element).data();
                return $(
                    `<div class="d-flex gap-2">${gatewayData.imageSrc ? `<div class="select2-image-wrapper"><img class="select2-image" src="${gatewayData.imageSrc}"></div>` : '' }<div class="select2-content"> <p class="select2-title">${gatewayData.title}</p><p class="select2-subtitle">${gatewayData.subtitle}</p></div></div>`
                );
            }

            $('.select2').each(function(index, element) {
                $(element).select2();
            });


            $('.select2-basic').each(function(index, element) {
                $(element).select2({
                    dropdownParent: $(element).closest('.select2-parent')
                });
            });

        })(jQuery);
    </script>

    <script>
        (function($) {
            "use strict";

            var inputElements = $('[type=text],[type=password],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input:not([type=checkbox]):not([type=hidden]), select, textarea'), function(i, element) {

                if (element.hasAttribute('required')) {
                    $(element).closest('.form-group').find('label').addClass('required');
                }

            });

            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle();
            });

            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });

            let disableSubmission = false;
            $('.disableSubmission').on('submit', function(e) {
                if (disableSubmission) {
                    e.preventDefault()
                } else {
                    disableSubmission = true;
                }
            });

        })(jQuery);
    </script>
@endpush
