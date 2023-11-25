@extends('admin::layouts.main')

@section('page_title')
    {{ __('subscription::subscription.subscription.name') }}
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
                'url'                   => route('admin.subscriptions.create'),
                'text'                  => '',
                'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
                'permission'            => 'subscription-list',
            ],
        ],
        'include_header'        => __('subscription::subscription.subscription.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.subscriptions.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'subscription-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.subscriptions.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.subscriptions.trash_all'),
                            'include_delete_all_permission'     => 'subscription-delete',
                            'include_index_table_data_route'    => route('admin.subscriptions.index'),
                            'include_table_rows'                => [
                                // 'thumbnail_url'     => __('subscription::subscription.subscription.form.thumbnail_url'),
                                'title'             => __('subscription::subscription.subscription.form.title'),
                                'duration'          => __('subscription::subscription.subscription.form.duration'),
                                'duration_type'     => __('subscription::subscription.subscription.form.duration_type'),
                                'price'             => __('subscription::subscription.subscription.form.price'),
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
    var include_change_status_route = "{{ route('admin.subscriptions.status_update') }}";
</script>
@endpush
