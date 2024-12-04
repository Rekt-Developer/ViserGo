@extends($activeTemplate . 'layouts.app')
@section('app_content')
    <div class="about-section py-120">
        <div class="container">
            <div class="row gy-4 align-items-center justify-content-center">
                <div class="col-lg-6">
                    <div class="about-item__wrapper">
                        <img class="img-fluid mx-auto mb-5" src="{{ getImage(getFilePath('maintenance') . '/' . @$maintenance->data_values->image, getFileSize('maintenance')) }}" alt="image">
                        <p>
                            @php echo $maintenance->data_values->description @endphp
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
