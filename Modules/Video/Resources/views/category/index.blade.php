@extends('admin::layouts.main')

@section('page_title')
    {{ __('video::video.category.name') }}
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
                'url'                   => route('admin.videocategories.create'),
                'text'                  => '',
                'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
                'permission'            => 'videocategory-list',
            ],
        ],
        'include_header'        => __('video::video.category.name'),
        'include_breadcrumbs'   => [
            route('dashboard')   => __('admin::auth.dashboard'),
            route('admin.videos.index')   => __('video::video.video.name'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.videocategories.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'videocategory-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.videocategories.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.videocategories.trash_all'),
                            'include_delete_all_permission'     => 'videocategory-delete',
                            'include_index_table_data_route'    => route('admin.videocategories.index'),
                            'include_table_rows'                => [
                                'icon'          => __('video::video.category.form.icon'),
                                'name'          => __('video::video.category.form.name'),
                                'code'          => __('video::video.category.form.code'),
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
    var include_change_status_route = "{{ route('admin.videocategories.status_update') }}";
</script>
@endpush
