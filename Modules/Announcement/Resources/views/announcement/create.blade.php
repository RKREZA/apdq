@extends('admin::layouts.main')

@section('page_title')
{{ __('core::core.create.title', ['name' => __('announcement::announcement.name')]) }}
@endsection

@push('css')

@endpush

@section('container')

    <form id="announcement_category_add_form" action="{{ route('admin.announcements.store') }}" method="POST" role="form" autocomplete="off">
        @csrf()

        @include('core::layouts.sticky_page_header', [
            'include_back_url'      => route('admin.announcements.index'),
            // 'include_button'       => [
            //     '1'       => [
            //         'url'                   => route('admin.announcements.create'),
            //         'text'                  => __('core::core.add_new',['name' => __('announcement::announcement.name')]),
            //         'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
            //         'permission'            => 'announcement-list',
            //     ],
            // ],
            'include_header'        => __('announcement::announcement.name'),
            'include_breadcrumbs'   => [
                route('dashboard')      => __('admin::auth.dashboard'),
                route('admin.announcements.index')      => __('announcement::announcement.name'),
            ],
            // 'include_trashes'       => [
            //     'url'                   => route('admin.announcements.trashes'),
            //     'text'                  => __('core::core.form.trash'),
            //     'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            //     'permission'            => 'announcement-trash',
            // ],
        ])



        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('type')) is-valid @endif @error('type') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('announcement::announcement.form.type') }}</span></label>
                            <select name="type" id="type" class="form-control select2">
                                <option readonly disabled selected>{{ __('announcement::announcement.form.select_type') }}</option>
                                <option value="Info">Info</option>
                                <option value="Success">Success</option>
                                <option value="Warning">Warning</option>
                                <option value="Danger">Danger</option>
                            </select>
                            @error('type')
                                <em class="error invalid-announcement" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-outline my-2 is-filled @if (old('serial')) is-valid @endif @error('serial') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('core::core.form.public') }}</span></label>
                            <select name="public" id="public" class="form-control">
                                <option value="1">{{ __('core::core.public') }}</option>
                                <option value="0">{{ __('core::core.private') }}</option>
                            </select>
                            @error('serial')
                                <em class="error" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-outline my-2 is-filled @if (old('serial')) is-valid @endif @error('serial') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('announcement::announcement.form.blink') }}</span></label>
                            <select name="blink" id="blink" class="form-control">
                                <option value="1">{{ __('core::core.on') }}</option>
                                <option value="0">{{ __('core::core.off') }}</option>
                            </select>
                            @error('serial')
                                <em class="error" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('description')) is-valid @endif @error('description') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('announcement::announcement.form.description') }}</span></label>
                            <textarea name="description" id="description" class="tiny form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                            @error('description')
                                <em class="error invalid-announcement" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        @can('announcement-create')
                            <button type="submit" class="create-button btn btn-dark btn-rounded mt-1 my-0 border-2" id="">
                                <img src="{{ asset('assets/backend/img/icons/optimized/save.png') }}" class="pageicon" alt="">
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
    var validation_id               = "#announcement_category_add_form";
    var errorElement                = "em";
    var rules                       = {
        description: {
            required: true,
        },
        type: {
            required: true,
        },
    };
    var messages                    = {
        description: {
            required: "{{ __('core::core.form.validation.required') }}",
        },
        type: {
            required: "{{ __('core::core.form.validation.required') }}",
        },
    };

    // Summernote
    var height                      = 300;
    var selector                    = '.tiny';
    var toolbar                     = [

            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['view', ['codeview', 'help']]
    ];
</script>
@endpush
