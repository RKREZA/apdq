@extends('admin::layouts.main')

@section('page_title')
    {{ __('blog::blog.category.name') }}
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
        'include_back_url'      => route('admin.posts.index'),
        'include_button'       => [
            '1'       => [
                'url'                   => route('admin.postcategories.create'),
                'text'                  => '',
                'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
                'permission'            => 'postcategory-list',
            ],
        ],
        'include_header'        => __('blog::blog.category.name'),
        'include_breadcrumbs'   => [
            route('dashboard')   => __('admin::auth.dashboard'),
            route('admin.posts.index')   => __('blog::blog.post.name'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.postcategories.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'postcategory-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.postcategories.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.postcategories.trash_all'),
                            'include_delete_all_permission'     => 'postcategory-delete',
                            'include_index_table_data_route'    => route('admin.postcategories.index'),
                            'include_table_rows'                => [
                                'name'          => __('blog::blog.category.form.name'),
                                'code'          => __('blog::blog.category.form.code'),
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
    var include_change_status_route = "{{ route('admin.postcategories.status_update') }}";
</script>
@endpush
