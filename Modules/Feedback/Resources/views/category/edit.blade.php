@extends('admin::layouts.main')

@section('page_title')
{{ __('core::core.edit.title', ['name' => __('feedback::feedback.category.name')]) }}
@endsection

@push('css')

@endpush

@section('container')

    <form id="feedback_category_edit_form" action="{{ route('admin.feedbackcategories.update', $feedbackcategory->id) }}" method="POST" role="form" autocomplete="off">
        @csrf()

        @include('core::layouts.sticky_page_header', [
            'include_back_url'      => route('admin.feedbackcategories.index'),
            // 'include_button'       => [
            //     '1'       => [
            //         'url'                   => route('admin.feedbackcategories.create'),
            //         'text'                  => __('core::core.add_new',['name' => __('feedback::feedback.category.name')]),
            //         'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
            //         'permission'            => 'feedbackcategory-list',
            //     ],
            // ],
            'include_header'        => __('core::core.edit.title', ['name' => __('feedback::feedback.category.name')]),
            'include_breadcrumbs'   => [
                route('dashboard')      => __('admin::auth.dashboard'),
                route('admin.feedbackcategories.index')      => __('feedback::feedback.category.name'),
            ],
            // 'include_trashes'       => [
            //     'url'                   => route('admin.feedbackcategories.trashes'),
            //     'text'                  => __('core::core.form.trash'),
            //     'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            //     'permission'            => 'feedbackcategory-trash',
            // ],
        ])



        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('name')) is-valid @endif @error('name') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('feedback::feedback.category.form.name') }}</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $feedbackcategory->name }}">
                            @error('name')
                                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('code')) is-valid @endif @error('code') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('feedback::feedback.category.form.code') }}</span></label>
                            <input type="text" name="code" class="form-control" value="{{ $feedbackcategory->code }}">
                            @error('code')
                                <em class="error invalid-feedback" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        @can('feedbackcategory-create')
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
var validation_id               = "#feedback_category_edit_form";
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
