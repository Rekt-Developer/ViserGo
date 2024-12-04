@if (gs('multi_language'))
    @php
        $language = App\Models\Language::all();
        $selectedLang = $language->where('code', session('lang'))->first();
    @endphp

    <div class="language dropdown d-xl-block me-2">
        <button class="language-wrapper" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="language-content">
                <span class="language_flag">
                    <img src="{{ getImage(getFilePath('language') . '/' . @$selectedLang->image, getFileSize('language')) }}" alt="flag">
                </span>
                <span class="language_text_select">{{ __(@$selectedLang->name) }}</span>
            </span>
            <span class="collapse-icon"><i class="las la-angle-down"></i></span>
        </button>
        <div class="dropdown-menu langList_dropdow py-2" style="">
            <ul class="langList">
                @foreach ($language as $item)
                    <li class="language-list langSel" data-code="{{ $item->code }}">
                        <div class="language_flag">
                            <img src="{{ getImage(getFilePath('language') . '/' . $item->image, getFileSize('language')) }}" alt="flag">
                        </div>
                        <p class="language_text">{{ __($item->name) }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
