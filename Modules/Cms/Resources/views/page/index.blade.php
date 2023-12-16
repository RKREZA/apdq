@extends('admin::layouts.main')

@section('page_title')
    {{ __('cms::cms.page.name') }}
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
                'url'                   => route('admin.pages.create'),
                'text'                  => '',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'page-create',
            ],
            '2'       => [
                'url'                   => route('admin.pagecategories.index'),
                'text'                  =>__('cms::cms.category.name'),
                'icon'                  => '<i class="fi fi-ss-clipboard-list-check"></i>',
                'permission'            => 'pagecategory-list',
            ],
        ],
        'include_header'        => __('cms::cms.page.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.pages.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'page-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.pages.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.pages.trash_all'),
                            'include_delete_all_permission'     => 'page-delete',
                            'include_index_table_data_route'    => route('admin.pages.index'),
                            'include_table_rows'                => [
                                'title'             => __('cms::cms.page.form.title'),
                                'category_id'       => __('cms::cms.page.form.category_id'),
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
    var include_change_status_route = "{{ route('admin.pages.status_update') }}";
</script>
@endpush
