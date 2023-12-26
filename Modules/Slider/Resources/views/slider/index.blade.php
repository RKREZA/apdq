@extends('admin::layouts.main')

@section('page_title')
    {{ __('slider::slider.slider.name') }}
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
        'include_back_url'      => route('dashboard'),
        'include_button'       => [
            '1'       => [
                'url'                   => route('admin.sliders.create'),
                'text'                  => '',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'slider-create',
            ],
            // '2'       => [
            //     'url'                   => route('admin.slidercategories.index'),
            //     'text'                  =>__('slider::slider.category.name'),
            //     'img'                   => asset('assets/backend/img/icons/optimized/list.png'),
            //     'permission'            => 'slidercategory-list',
            // ],
        ],
        'include_header'        => __('slider::slider.slider.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.sliders.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'slider-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.sliders.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.sliders.trash_all'),
                            'include_delete_all_permission'     => 'slider-delete',
                            'include_index_table_data_route'    => route('admin.sliders.index'),
                            'include_table_rows'                => [
                                'photo'             => __('core::core.form.photo'),
                                'title'             => __('slider::slider.slider.form.title'),
                                'category_id'       => __('slider::slider.slider.form.category_id'),
                                'status'            => __('core::core.form.status'),
                                'created_at'        => __('core::core.form.created_at'),
                                'action'            => __('core::core.form.action'),
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
    var include_change_status_route = "{{ route('admin.sliders.status_update') }}";
</script>
@endpush
