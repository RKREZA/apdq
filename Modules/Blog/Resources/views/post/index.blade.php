@extends('admin::layouts.main')

@section('page_title')
    {{ __('blog::blog.post.name') }}
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
                'url'                   => route('admin.posts.create'),
                'text'                  => '',
                'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
                'permission'            => 'post-list',
            ],
            '2'       => [
                'url'                   => route('admin.postcategories.index'),
                'text'                  =>__('blog::blog.category.name'),
                'img'                   => asset('assets/backend/img/icons/optimized/list.png'),
                'permission'            => 'postcategory-list',
            ],
        ],
        'include_header'        => __('blog::blog.post.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.posts.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'post-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.posts.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.posts.trash_all'),
                            'include_delete_all_permission'     => 'post-delete',
                            'include_index_table_data_route'    => route('admin.posts.index'),
                            'include_table_rows'                => [
                                'photo'             => __('core::core.form.photo'),
                                'title'             => __('blog::blog.post.form.title'),
                                'description'       => __('blog::blog.post.form.description'),
                                'category_id'       => __('blog::blog.post.form.category_id'),
                                'status'            => __('core::core.form.status'),
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
    var include_change_status_route = "{{ route('admin.posts.status_update') }}";
</script>
@endpush
