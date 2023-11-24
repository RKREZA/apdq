@extends('admin::layouts.main')

@section('page_title')
    {{ __('feedback::feedback.feedback.name') }}
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
                'url'                   => route('admin.feedbackcategories.index'),
                'text'                  => __('feedback::feedback.category.name'),
                'img'                   => asset('assets/backend/img/icons/optimized/list.png'),
                'permission'            => 'feedbackcategory-list',
            ],
        ],
        'include_header'        => __('feedback::feedback.feedback.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.feedbacks.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'feedback-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.feedbacks.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.feedbacks.trash_all'),
                            'include_delete_all_permission'     => 'feedback-delete',
                            'include_index_table_data_route'    => route('admin.feedbacks.index'),
                            'include_table_rows'                => [
                                'name'          => __('feedback::feedback.feedback.form.name'),
                                'mobile'        => __('feedback::feedback.feedback.form.mobile'),
                                'category_id'   => __('feedback::feedback.feedback.form.category_id'),
                                'created_at'    => __('core::core.form.created_at'),
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
    var include_change_status_route = "{{ route('admin.feedbacks.status_update') }}";
</script>
@endpush
