@extends('admin::layouts.main')

@section('page_title')
{{ __('core::core.edit.title', ['name' => __('cms::cms.category.name')]) }}
@endsection

@push('css')

@endpush

@section('container')

    <form id="page_category_edit_form" action="{{ route('admin.pagecategories.update', $pagecategory->id) }}" method="Page" role="form" autocomplete="off">
        @csrf()

        @include('core::layouts.sticky_page_header', [
            'include_back_url'      => route('admin.pagecategories.index'),
            // 'include_button'       => [
            //     '1'       => [
            //         'url'                   => route('admin.pagecategories.create'),
            //         'text'                  => __('core::core.add_new',['name' => __('cms::cms.category.name')]),
            //         'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
            //         'permission'            => 'pagecategory-list',
            //     ],
            // ],
            'include_header'        => __('core::core.edit.title', ['name' => __('cms::cms.category.name')]),
            'include_breadcrumbs'   => [
                route('dashboard')      => __('admin::auth.dashboard'),
                route('admin.pages.index')   => __('cms::cms.page.name'),
                route('admin.pagecategories.index')      => __('cms::cms.category.name'),
            ],
            // 'include_trashes'       => [
            //     'url'                   => route('admin.pagecategories.trashes'),
            //     'text'                  => __('core::core.form.trash'),
            //     'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            //     'permission'            => 'pagecategory-trash',
            // ],
        ])



        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('name')) is-valid @endif @error('name') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('cms::cms.category.form.name') }}</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $pagecategory->name }}">
                            @error('name')
                                <em class="error invalid-page" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="input-group input-group-outline my-2 is-filled @if(old('code')) is-valid @endif @error('code') is-invalid @enderror">
                            <label class="form-label"><span class="required">{{ __('cms::cms.category.form.code') }}</span></label>
                            <input type="text" name="code" class="form-control" value="{{ $pagecategory->code }}">
                            @error('code')
                                <em class="error invalid-page" style="display: inline-block;">{{ $message }}</em>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        @can('pagecategory-create')
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
var validation_id               = "#page_category_edit_form";
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
