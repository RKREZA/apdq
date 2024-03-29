@php
    $languages = \Modules\Language\Entities\Language::where('status','Active')->get();
@endphp
<li class="nav-item dropdown">
    <a href="javascript:;" class="nav-link change-language" id="dropdownMenuButton"
        data-bs-toggle="dropdown" aria-expanded="false" data-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="{{ __('core::core.form.change-language') }}">

        <i class="fi fi-ss-language"></i>

        <span class="language-text" style="">
            @foreach ($languages as $language)
                @if (Session::get('locale') === $language->code)
                    {{ $language->name }}
                @elseif (config('app.locale') == $language->code)
                    {{ $language->name }}
                @endif
            @endforeach
        </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
        @if ($languages)
            @foreach ($languages as $language)
                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="{{ route('setlocale', $language->code) }}">
                        <div class="d-flex align-items-center py-1">
                            <div class="ms-2">
                                <h6 class="text-sm font-weight-normal my-auto">
                                    @if (Session::get('locale') === $language->code)
                                        <i class="material-icons fixed-plugin-button-nav cursor-pointer">
                                            check
                                        </i>
                                    @elseif (config('app.locale') == $language->code)
                                        <i class="material-icons fixed-plugin-button-nav cursor-pointer">
                                            check
                                        </i>
                                    @endif
                                    {{ $language->name }}
                                </h6>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</li>
