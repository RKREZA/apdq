@php
    $languages = \Modules\Language\Entities\Language::get();
@endphp

<li class="nav-item dropdown" style="float: left">
    <a href="javascript:;" class="nav-link" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="language-text" style="">
            @foreach ($languages as $language)
                @if (Session::get('locale') === $language->code)
                    @if (Session::get('locale') === 'bn')
                        <img src="{{ asset('assets/frontend/img/bangladesh-flag.png') }}" style="height: 14px; display: inline-block">
                    @elseif (Session::get('locale') === 'en')
                        <img src="{{ asset('assets/frontend/img/usa-flag.png') }}" style="height: 14px; display: inline-block">
                    @endif
                    {{ $language->name }}
                @elseif (config('app.locale') == $language->code)
                    @if (config('app.locale') === 'bn')
                        <img src="{{ asset('assets/frontend/img/bangladesh-flag.png') }}" style="height: 14px; display: inline-block">
                    @elseif (config('app.locale') === 'en')
                        <img src="{{ asset('assets/frontend/img/usa-flag.png') }}" style="height: 14px; display: inline-block">
                    @endif
                    {{ $language->name }}
                @endif
            @endforeach
        </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="dropdownMenuButton">
        @if ($languages)
            @foreach ($languages as $language)
                <li class="">
                    <a class="dropdown-item border-radius-md" href="{{ route('setlocale', $language->code) }}">
                        {{ $language->name }}
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</li>
