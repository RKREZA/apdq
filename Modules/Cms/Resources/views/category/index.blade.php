@extends('admin::layouts.main')

@section('page_title')
    {{ __('cms::cms.category.name') }}
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
        'include_back_url'      => route('admin.pages.index'),
        'include_button'       => [
            '1'       => [
                'url'                   => route('admin.pagecategories.create'),
                'text'                  => '',
                'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
                'permission'            => 'pagecategory-list',
            ],
        ],
        'include_header'        => __('cms::cms.category.name'),
        'include_breadcrumbs'   => [
            route('dashboard')   => __('admin::auth.dashboard'),
            route('admin.pages.index')   => __('cms::cms.page.name'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.pagecategories.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'pagecategory-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.pagecategories.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.pagecategories.trash_all'),
                            'include_delete_all_permission'     => 'pagecategory-delete',
                            'include_index_table_data_route'    => route('admin.pagecategories.index'),
                            'include_table_rows'                => [
                                'name'          => __('cms::cms.category.form.name'),
                                'code'          => __('cms::cms.category.form.code'),
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
    var include_change_status_route = "{{ route('admin.pagecategories.status_update') }}";
</script>
@endpush
