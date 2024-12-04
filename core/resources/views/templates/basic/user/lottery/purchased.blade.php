@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center gy-4">
            <div class="col-md-12">
                @include($activeTemplate . 'partials.ticket_table', ['lotteries' => $lotteries])
            </div>
        </div>
    </div>
@endsection
