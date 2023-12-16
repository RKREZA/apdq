@extends('admin::layouts.main')

@section('page_title')
    {{ __('feedback::feedback.category.name') }}
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
                'url'                   => route('admin.feedbackcategories.create'),
                'text'                  => "",
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'feedbackcategory-create',
            ],
        ],
        'include_header'        => __('feedback::feedback.category.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.feedbackcategories.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'feedbackcategory-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.feedbackcategories.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.feedbackcategories.trash_all'),
                            'include_delete_all_permission'     => 'feedbackcategory-delete',
                            'include_index_table_data_route'    => route('admin.feedbackcategories.index'),
                            'include_table_rows'                => [
                                'name'          => __('feedback::feedback.category.form.name'),
                                'code'          => __('feedback::feedback.category.form.code'),
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
    var include_change_status_route = "{{ route('admin.feedbackcategories.status_update') }}";
</script>
@endpush
