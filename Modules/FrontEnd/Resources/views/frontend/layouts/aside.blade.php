<aside id="myDrawer" class="drawer pt-5">
    <ul class="">
        <li>
            <a href="">
                <i class="fi fi-sr-house-blank"></i>
                <span>Accueil</span>
            </a>
        </li>

        @foreach(\Modules\Video\Entities\VideoCategory::where('status','Active')->get() as $video_category)
            <li>
                <a href="">
                    {!! $video_category->icon !!}
                    <span>{{ $video_category->name }}</span>
                </a>
            </li>
        @endforeach

        <li>
            <a href="">
                <i class="fi fi-sr-folder-open"></i>
                <span>Archive</span>
            </a>
        </li>

    </ul>
</aside>
