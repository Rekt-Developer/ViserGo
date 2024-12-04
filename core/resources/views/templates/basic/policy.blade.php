@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="contact-section py-120">
        <div class="container">
            <p>
                @php
                    echo $policy->data_values->details;
                @endphp
            </p>
        </div>
    </div>
@endsection
