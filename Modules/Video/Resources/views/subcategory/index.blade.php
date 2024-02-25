@extends('admin::layouts.main')

@section('page_title')
    {{ __('video::video.subcategory.name') }}
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
        'include_back_url'      => route('admin.videos.index'),
        'include_button'       => [
            '1'       => [
                'url'                   => route('admin.videosubcategories.create'),
                'text'                  => '',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'videosubcategory-list',
            ],
        ],
        'include_header'        => __('video::video.subcategory.name'),
        'include_breadcrumbs'   => [
            route('dashboard')   => __('admin::auth.dashboard'),
            route('admin.videos.index')   => __('video::video.video.name'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.videosubcategories.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'videosubcategory-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.videosubcategories.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.videosubcategories.trash_all'),
                            'include_delete_all_permission'     => 'videosubcategory-delete',
                            'include_index_table_data_route'    => route('admin.videosubcategories.index'),
                            'include_table_rows'                => [
                                'serial'        => __('video::video.subcategory.form.serial'),
                                'name'          => __('video::video.subcategory.form.name'),
                                'code'          => __('video::video.subcategory.form.code'),
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
    var include_change_status_route = "{{ route('admin.videosubcategories.status_update') }}";
</script>
@endpush
