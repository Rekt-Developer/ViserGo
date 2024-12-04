@php
    $breadcrumb = getContent('breadcrumb.content', true);
@endphp

<section class="breadcrumb bg_img" style="background: url('{{ frontendImage('breadcrumb', @$breadcrumb->data_values->image, '1295x425') }}')">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="breadcrumb__wrapper">
                    <h2 class="breadcrumb__title"> {{ __($pageTitle) }} </h2>
                </div>
            </div>
        </div>
    </div>
</section>
