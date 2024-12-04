@php
    $counterElement = getContent('counter.element');
@endphp

<div class="counter-up-section">
    <div class="container">
        <div class="row">
            <div class="counterup-item">
                @foreach ($counterElement as $item)
                    <div class="counterup-item__content">
                        <div class="d-flex counterup-wrapper">
                            <span class="counterup-item__icon">
                                @php
                                    echo @$item->data_values->counter_icon;
                                @endphp
                            </span>
                            <div class="content">
                                <div class="counterup-item__number">
                                    <h3 class="counterup-item__title mb-0">
                                        {{ @$item->data_values->counter_digit }}
                                    </h3>
                                </div>
                                <span class="counterup-item__text mb-0"> {{ __(@$item->data_values->title) }} </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
