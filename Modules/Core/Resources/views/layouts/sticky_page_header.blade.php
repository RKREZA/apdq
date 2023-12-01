<div class="position-sticky top-0 mb-0 border-radius-xl z-index-sticky">
    <div class="row">
        <div class="col-md-12 p-0">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-md-1 col-2">
                            @if(isset($include_back_url) && !empty($include_back_url))
                                <a href="{{ $include_back_url }}" class="go_back" title="{{ __('core::core.go_back') }}" data-toggle="tooltip" data-bs-placement="right">
                                    {{-- <img src="{{ asset('assets/backend/img/icons/optimized/back.png') }}" class="pageicon_sm" alt=""> --}}
                                    <i class="fi fi-ss-angle-left"></i>
                                </a>
                            @endif
                        </div>
                        <div class="col px-3 py-2">
                            <div class="row">
                                <div class="col-6 col-md-5">
                                    @isset($include_breadcrumbs)

                                        <nav aria-label="breadcrumb" class="d-none d-md-block">
                                            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                                                @foreach ($include_breadcrumbs as $key => $value)
                                                    <li class="breadcrumb-item text-xs"><a class="opacity-5 text-dark" href="{{ $key }}">{{ $value }}</a></li>
                                                @endforeach

                                                @isset($include_header)
                                                    <li class="breadcrumb-item text-xs text-dark active" aria-current="page">{{ $include_header }}</li>
                                                @endisset

                                            </ol>
                                        </nav>
                                    @endisset

                                    <h6 class="font-weight-bolder mb-0">
                                        @isset($include_header)
                                            {{ $include_header }}
                                        @endisset
                                    </h6>
                                </div>

                                <div class="col-6 col-md-7">
                                   <div class="">
                                        @if(isset($include_button) && !empty($include_button))
                                            @foreach ($include_button as $button)
                                                @can($button['permission'])
                                                    @if (isset($button['data-bs-target']))
                                                        <button data-bs-toggle="modal"  data-bs-target="{{ $button['data-bs-target'] }}" class="create-button btn btn-outline-dark btn-rounded mt-1 ms-1 my-0 float-end">
                                                            {{-- @isset($button['img'])
                                                                <img src="{{ $button['img'] }}" class="pageicon" alt="">
                                                            @endisset --}}

                                                            <i class="fi fi-ss-add"></i>

                                                            @isset($button['text'])
                                                                {{ $button['text'] }}
                                                            @endisset
                                                        </button>
                                                    @else
                                                        @if (isset($button['target']))
                                                            <a href="@isset($button['url']) {{ $button['url'] }} @endisset" target="{{ $button['target'] }}" class="create-button btn btn-outline-dark btn-rounded mt-1 ms-1 my-0 float-end">
                                                                {{-- @isset($button['img'])
                                                                    <img src="{{ $button['img'] }}" class="pageicon" alt="">
                                                                @endisset --}}

                                                                <i class="fi fi-ss-add"></i>

                                                                @isset($button['text'])
                                                                    {{ $button['text'] }}
                                                                @endisset
                                                            </a>

                                                        @else
                                                            <a href="@isset($button['url']) {{ $button['url'] }} @endisset" class="create-button btn btn-outline-dark btn-rounded mt-1 ms-1 my-0 float-end">
                                                                {{-- @isset($button['img'])
                                                                    <img src="{{ $button['img'] }}" class="pageicon" alt="">
                                                                @endisset --}}
                                                                <i class="fi fi-ss-add"></i>

                                                                @isset($button['text'])
                                                                    {{ $button['text'] }}
                                                                @endisset
                                                            </a>

                                                        @endif
                                                    @endif
                                                @endcan
                                            @endforeach
                                        @endif
                                   </div>
                                </div>
                            </div>
                        </div>

                        @if (isset($include_trashes))
                            @can($include_trashes['permission'])
                                <div class="col-md-1 col-2">
                                    <a href="@isset($include_trashes['url']) {{ $include_trashes['url'] }} @endisset" title="@isset($include_trashes['text']){{ $include_trashes['text'] }}@endisset" data-toggle="tooltip" class="trash_button">
                                        {{-- @isset($include_trashes['img'])
                                            <img src="{{ asset('assets/backend/img/icons/optimized/trash.png') }}" class="pageicon" alt="">
                                        @endisset --}}
                                        <i class="fi fi-ss-trash"></i>
                                    </a>
                                </div>
                            @endcan
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
