@php
    $workContent = getContent('how_it_works.content', true);
    $workElements = getContent('how_it_works.element');
@endphp

<section class="how-section py-120 bg_img" style="background: url({{ asset($activeTemplateTrue . 'images/h-1.jpg') }})">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2 class="section-heading__title">{{ @$workContent->data_values->heading }}</h2>
                    <p class="section-heading__desc">
                        {{ @$workContent->data_values->subheading }}
                    </p>
                </div>
            </div>
        </div>

        <div class="how-work-wrapper">
            @foreach ($workElements as $item)
                <div class="work-item">
                    <div class="work-item__header">
                        <h3 class="work-item__title"> {{ @$item->data_values->title }}</h3>
                    </div>
                    <div class="work-item__body">
                        <h6 class="text"> {{ @$item->data_values->textarea }}</h6>
                    </div>
                    <div class="work-item__icon">
                        @php
                            echo @$item->data_values->icon;
                        @endphp
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
