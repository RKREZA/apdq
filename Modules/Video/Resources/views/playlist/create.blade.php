@extends('admin::layouts.main')

@section('page_title')
{{ __('core::core.create.title', ['name' => __('video::video.playlist.name')]) }}
@endsection

@push('css')

@endpush

@section('container')

    <form id="video_playlist_add_form" action="{{ route('admin.videoplaylists.store') }}" method="POST" role="form" autocomplete="off">
        @csrf()

        @include('core::layouts.sticky_page_header', [
            'include_back_url'      => route('admin.videoplaylists.index'),
            // 'include_button'       => [
            //     '1'       => [
            //         'url'                   => route('admin.videoplaylists.create'),
            //         'text'                  => __('core::core.add_new',['name' => __('video::video.playlist.name')]),
            //         'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
            //         'permission'            => 'videoplaylist-list',
            //     ],
            // ],
            'include_header'        => __('core::core.create.title', ['name' => __('video::video.playlist.name')]),
            'include_breadcrumbs'   => [
                route('dashboard')      => __('admin::auth.dashboard'),
                route('admin.videos.index')   => __('video::video.video.name'),
                route('admin.videoplaylists.index')      => __('video::video.playlist.name'),
            ],
            // 'include_trashes'       => [
            //     'url'                   => route('admin.videoplaylists.trashes'),
            //     'text'                  => __('core::core.form.trash'),
            //     'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            //     'permission'            => 'videoplaylist-trash',
            // ],
        ])



        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('name')) is-valid @endif @error('name') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('video::video.playlist.form.name') }}</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        @can('videoplaylist-create')
                            <button type="submit" class="create-button btn btn-dark btn-rounded mt-1 my-0 border-2 float-end" id="">
                                <i class="fi fi-ss-disk"></i>
                                {{ __('core::core.save') }}
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

    </form>



@endsection


@push('js')

<script>
// Validation
var validation_id               = "#video_playlist_add_form";
        var errorElement                = "em";
        var rules                       = {
            name: {
                required: true,
            }
        };
        var messages                    = {
            name: {
                required: "{{ __('core::core.form.validation.required') }}",
            }
        };
</script>
@endpush
