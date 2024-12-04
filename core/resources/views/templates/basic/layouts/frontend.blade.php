@extends($activeTemplate . 'layouts.app')

@section('app_content')
    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    @include($activeTemplate . 'partials.header')

    @if (!request()->routeIs('home'))
        @include($activeTemplate . 'partials.breadcrumb')
    @endif

    @yield('content')

    @include($activeTemplate . 'partials.cookie')

    @include($activeTemplate . 'partials.footer')
@endsection

@push('style-lib')
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/odometer.css') }}" />
@endpush

@push('script-lib')
    <script src="{{ asset($activeTemplateTrue . 'js/odometer.min.js') }}"></script>
@endpush
