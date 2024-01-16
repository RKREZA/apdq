@extends('admin::layouts.main')

@section('page_title')
{{ __('core::core.edit.title', ['name' => __('video::video.category.name')]) }}
@endsection

@push('css')

@endpush

@section('container')

    <form id="video_category_edit_form" action="{{ route('admin.videocategories.update', $videocategory->id) }}" method="POST" role="form" autocomplete="off">
        @csrf()

        @include('core::layouts.sticky_page_header', [
            'include_back_url'      => route('admin.videocategories.index'),
            // 'include_button'       => [
            //     '1'       => [
            //         'url'                   => route('admin.videocategories.create'),
            //         'text'                  => __('core::core.add_new',['name' => __('video::video.category.name')]),
            //         'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
            //         'permission'            => 'videocategory-list',
            //     ],
            // ],
            'include_header'        => __('core::core.edit.title', ['name' => __('video::video.category.name')]),
            'include_breadcrumbs'   => [
                route('dashboard')      => __('admin::auth.dashboard'),
                route('admin.videos.index')   => __('video::video.video.name'),
                route('admin.videocategories.index')      => __('video::video.category.name'),
            ],
            // 'include_trashes'       => [
            //     'url'                   => route('admin.videocategories.trashes'),
            //     'text'                  => __('core::core.form.trash'),
            //     'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            //     'permission'            => 'videocategory-trash',
            // ],
        ])



        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('name')) is-valid @endif @error('name') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('video::video.category.form.name') }}</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $videocategory->name }}">
                            @error('name')
                                <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('code')) is-valid @endif @error('code') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('video::video.category.form.code') }}</span></label>
                            <input type="text" disabled class="form-control" value="{{ $videocategory->code }}">
                            @error('code')
                                <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('icon')) is-valid @endif @error('icon') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('video::video.category.form.icon') }} {{ __('video::video.category.form.icon_from') }}</span></label>
                            <input type="text" name="icon" class="form-control" value="{{ $videocategory->icon }}">
                            @error('icon')
                                <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('description')) is-valid @endif @error('description') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('video::video.category.form.description') }}</span></label>
                            <textarea name="description" class="form-control" row="4">{{ $videocategory->description }}</textarea>
                            @error('description')
                                <em class="error invalid-video" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        @can('videocategory-create')
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
