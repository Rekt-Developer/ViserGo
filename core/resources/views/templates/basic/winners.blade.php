@extends($activeTemplate . 'layouts.frontend')
@section('content')
    <section class="py-120">
        <div class="container">
            <div class="row gy-2 justify-content-center">
                @forelse ($winners as $winner)
                    <div class="col-xl-4 col-md-6">
                        <div class="winner-card">
                            <div class="investor-item">
                                <div class="investor-item__thumb">
                                    <img src="{{ getImage(getFilePath('userProfile') . '/' . @$winner->user->image, '60x60', true) }}" alt="top" />
                                </div>
                                <div class="investor-item__content">
                                    <h4 class="name">{{ __(@$winner->user->fullname) }}</h4>
                                    <h4 class="name">{{ __(@$winner->lottery->name) }}</h4>
                                    <h4 class="name">@lang('Ticket No') : {{ @$winner->ticket_number }}</h4>
                                    <h4 class="name">@lang('Drawn Date') : {{ showDateTime(@$winner->lottery->draw_date, 'd M Y h:i') }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-message-area">
                        <img src="{{ getImage($activeTemplateTrue . 'images/empty.png') }}" alt="img">
                        <h6 class="text--danger">@lang('No winner found yet!')</h6>
                    </div>
                @endforelse
                @if ($winners->hasPages())
                    {{ paginateLinks($winners) }}
                @endif
            </div>
        </div>
    </section>
    @if ($sections)
        @foreach (json_decode($sections) as $sec)
            @include($activeTemplate . 'sections.' . $sec)
        @endforeach
    @endif
@endsection

@push('style')
    <style>
        .investor-item__content .name {
            font-size: 16px;
            font-weight: 500;
        }
    </style>
@endpush
