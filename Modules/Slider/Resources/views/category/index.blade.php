@extends('admin::layouts.main')

@section('page_title')
    {{ __('slider::slider.category.name') }}
@endsection

@push('css')
    <style>
        .table tr td {
            vertical-align: middle;
        }
    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'      => route('admin.sliders.index'),
        'include_button'       => [
            '1'       => [
                'url'                   => route('admin.slidercategories.create'),
                'text'                  => '',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'slidercategory-create',
            ],
        ],
        'include_header'        => __('slider::slider.category.name'),
        'include_breadcrumbs'   => [
            route('dashboard')   => __('admin::auth.dashboard'),
            route('admin.sliders.index')   => __('slider::slider.slider.name'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.slidercategories.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'slidercategory-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.slidercategories.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.slidercategories.trash_all'),
                            'include_delete_all_permission'     => 'slidercategory-delete',
                            'include_index_table_data_route'    => route('admin.slidercategories.index'),
                            'include_table_rows'                => [
                                'name'          => __('slider::slider.category.form.name'),
                                'code'          => __('slider::slider.category.form.code'),
                                'status'        => __('core::core.form.status'),
                                'action'        => __('core::core.form.action'),
                            ],
                        ])
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection




@push('js')
<script>

    // Change Status
    var include_change_status_route = "{{ route('admin.slidercategories.status_update') }}";
</script>
@endpush
