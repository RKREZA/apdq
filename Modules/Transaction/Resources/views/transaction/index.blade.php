@extends('admin::layouts.main')

@section('page_title')
    {{ __('transaction::transaction.transaction.name') }}
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
            // '1'       => [
            //     'url'                   => route('admin.transactions.create'),
            //     'text'                  => '',
            //     'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
            //     'permission'            => 'transaction-list',
            // ],
        ],
        'include_header'        => __('transaction::transaction.transaction.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        // 'include_trashes'       => [
        //     'url'                   => route('admin.transactions.trashes'),
        //     'text'                  => __('core::core.form.trash'),
        //     'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
        //     'permission'            => 'transaction-delete',
        // ],
    ])

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.transactions.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.transactions.trash_all'),
                            'include_delete_all_permission'     => 'transaction-delete',
                            'include_index_table_data_route'    => route('admin.transactions.index'),
                            'include_table_rows'                => [
                                'subscription_id'       => __('transaction::transaction.transaction.form.subscription_id'),
                                'paymentgateway_id'     => __('transaction::transaction.transaction.form.paymentgateway_id'),
                                'transaction_id'        => __('transaction::transaction.transaction.form.transaction_id'),
                                'payment_amount'        => __('transaction::transaction.transaction.form.payment_amount'),
                                'email'                 => __('transaction::transaction.transaction.form.email'),
                                'status'                => __('core::core.form.status'),
                                'created_at'            => __('core::core.form.created_at'),
                                'action'                => __('core::core.form.action')
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
    var include_change_status_route = "{{ route('admin.transactions.status_update') }}";
</script>
@endpush
