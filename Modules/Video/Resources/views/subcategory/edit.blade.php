@extends('admin::layouts.main')

@section('page_title')
{{ __('core::core.edit.title', ['name' => __('video::video.subcategory.name')]) }}
@endsection

@push('css')

@endpush

@section('container')

    <form id="video_category_edit_form" action="{{ route('admin.videosubcategories.update', $videosubcategory->id) }}" method="POST" role="form" autocomplete="off">
        @csrf()

        @include('core::layouts.sticky_page_header', [
            'include_back_url'      => route('admin.videosubcategories.index'),
            // 'include_button'       => [
            //     '1'       => [
            //         'url'                   => route('admin.videosubcategories.create'),
            //         'text'                  => __('core::core.add_new',['name' => __('video::video.subcategory.name')]),
            //         'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
            //         'permission'            => 'videosubcategory-list',
            //     ],
            // ],
            'include_header'        => __('core::core.edit.title', ['name' => __('video::video.subcategory.name')]),
            'include_breadcrumbs'   => [
                route('dashboard')      => __('admin::auth.dashboard'),
                route('admin.videos.index')   => __('video::video.video.name'),
                route('admin.videosubcategories.index')      => __('video::video.subcategory.name'),
            ],
            // 'include_trashes'       => [
            //     'url'                   => route('admin.videosubcategories.trashes'),
            //     'text'                  => __('core::core.form.trash'),
            //     'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            //     'permission'            => 'videosubcategory-trash',
            // ],
        ])



        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('serial')) is-valid @endif @error('serial') is-invalid @enderror">
                            <label class="form-label"><span class="">{{ __('video::video.subcategory.form.serial') }}</span></label>
                            <input type="number" name="serial" class="form-control" value="{{ $videosubcategory->serial }}">
                            @error('serial')
                                <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('name')) is-valid @endif @error('name') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('video::video.subcategory.form.name') }}</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $videosubcategory->name }}">
                            @error('name')
                                <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('code')) is-valid @endif @error('code') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('video::video.subcategory.form.code') }}</span></label>
                            <input type="text" disabled class="form-control" value="{{ $videosubcategory->code }}">
                            @error('code')
                                <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('description')) is-valid @endif @error('description') is-invalid @enderror">
                            <label class="form-label"><span class="">{{ __('video::video.subcategory.form.description') }}</span></label>
                            <textarea name="description" class="form-control" row="4">{{ $videosubcategory->description }}</textarea>
                            @error('description')
                                <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        @can('videosubcategory-create')
                            <button type="submit" class="update-button btn btn-dark btn-rounded mt-1 my-0 border-2 float-end" id="">
                                <i class="fi fi-ss-disk"></i>
                                {{ __('core::core.update') }}
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
var validation_id               = "#video_category_edit_form";
        var errorElement                = "em";
        var rules                       = {
            name: {
                required: true,
            },
            code: {
                required: true,
            },
        };
        var messages                    = {
            name: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
            code: {
                required: "{{ __('core::core.form.validation.required') }}",
            },
        };
</script>
@endpush
