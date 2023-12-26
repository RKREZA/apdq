<aside id="myDrawer" class="drawer pt-5">
    <ul class="">
        <li>
            <a href="/" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-custom-class="custom-tooltip"
                        data-bs-title="Accueil">
                <i class="fi fi-sr-house-blank"></i>
                <span>Accueil</span>
            </a>
        </li>

        @foreach(\Modules\Video\Entities\VideoCategory::where('status','Active')->get() as $video_category)
            <li>
                <a href="{{ route('frontend.video') }}?code={{ $video_category->code }}" data-bs-toggle="tooltip" data-bs-placement="right"
                                                                                        data-bs-custom-class="custom-tooltip"
                                                                                        data-bs-title="{{ $video_category->name }}">
                    {!! $video_category->icon !!}
                    <span>{{ $video_category->name }}</span>
                </a>
            </li>
        @endforeach

        <li>
            <a href="" data-bs-toggle="tooltip" data-bs-placement="right"
                        data-bs-custom-class="custom-tooltip"
                        data-bs-title="Archive">
                <i class="fi fi-sr-folder-open"></i>
                <span>Archive</span>
            </a>
        </li>

    </ul>
</aside>
