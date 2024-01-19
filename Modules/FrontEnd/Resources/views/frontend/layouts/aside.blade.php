<aside id="myDrawer" class="drawer pt-5">
    <ul class="">
        <li>
            <a href="/" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-custom-class="custom-tooltip"
                        data-bs-title="Accueil"
                        class="{{ request()->is('/') ? 'text-white' : '' }}">
                <i class="fi fi-sr-house-blank"></i>
                <span>Accueil</span>
            </a>
        </li>

        @foreach(\Modules\Video\Entities\VideoCategory::where('status','Active')->orderByRaw('ISNULL(serial), serial ASC')->get() as $video_category)
            <li>
                <a href="{{ route('frontend.video') }}?code={{ $video_category->code }}" data-bs-toggle="tooltip" data-bs-placement="right"
                                                                                        data-bs-custom-class="custom-tooltip"
                                                                                        data-bs-title="{{ $video_category->name }}"
                                                                                        class="{{ request()->has('code') && $video_category->code == request()->code ? 'text-white' : '' }}">
                    {!! $video_category->icon !!}
                    <span>{{ $video_category->name }}</span>
                </a>
            </li>
        @endforeach

        <li class="dropdown dropend">
            <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-custom-class="custom-tooltip"
                        data-bs-title="Archive"
                        class="dropdown-item dropdown-toggle"
                        id="multilevelDropdownMenu1"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                <i class="fi fi-sr-folder-open"></i>
                <span>Archive</span>
            </a>

            <ul class="dropdown-menu {{ request()->is('video*') ? 'd-block' : '' }}" aria-labelledby="multilevelDropdownMenu1">
                @foreach ($yearsMonths as $year => $months)
                    <li class="dropdown dropend">
                        <a class="dropdown-item dropdown-toggle" href="javascript:void(0);" id="multilevelDropdownMenu{{ $loop->index + 1 }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fi fi-ss-bullet"></i>
                            {{ $year }}
                        </a>
                        <ul class="dropdown-menu {{ request()->has('year') && request()->year == $year ? 'd-block' : '' }}" aria-labelledby="multilevelDropdownMenu{{ $loop->index + 2 }}">
                            @foreach ($months as $month)
                                <li><a class="dropdown-item {{ request()->has('year') && request()->month == $month ? 'text-white' : '' }}" href="{{ route('frontend.video') }}?year={{ $year }}&month={{ $month }}"><i class="fi fi-rs-bullet"></i> {{ $month }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </li>

    </ul>
</aside>


@push('js')
<script>
    let dropdowns = document.querySelectorAll('#myDrawer .dropdown-toggle');

    dropdowns.forEach((dd) => {
        dd.addEventListener('click', function (e) {
            var el = this.nextElementSibling;
            el.classList.toggle('d-block');
        });
    });
</script>
@endpush
