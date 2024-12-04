@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <div class="contact-section py-120">
        <div class="container">
            <p>
                @php
                    echo $cookie->data_values->description;
                @endphp
            </p>
        </div>
    </div>
@endsection
