@extends('admin::layouts.main')

@section('page_title')
    {{ __('paymentgateway::paymentgateway.paymentgateway.name') }}
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
            //     'url'                   => route('admin.paymentgateways.create'),
            //     'text'                  => '',
            //     'icon'                  => '<i class="fi fi-ss-add"></i>',
            //     'permission'            => 'paymentgateway-create',
            // ],
        ],
        'include_header'        => __('paymentgateway::paymentgateway.paymentgateway.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        // 'include_trashes'       => [
        //     'url'                   => route('admin.paymentgateways.trashes'),
        //     'text'                  => __('core::core.form.trash'),
        //     'permission'            => 'paymentgateway-delete',
        // ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            // 'include_delete_all_url'            => route('admin.paymentgateways.force_destroy_all'),
                            // 'include_trash_all_url'             => route('admin.paymentgateways.trash_all'),
                            // 'include_delete_all_permission'     => 'paymentgateway-delete',
                            'include_index_table_data_route'    => route('admin.paymentgateways.index'),
                            'include_table_rows'                => [
                                'name'              => __('paymentgateway::paymentgateway.paymentgateway.form.name'),
                                'code'              => __('paymentgateway::paymentgateway.paymentgateway.form.code'),
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
    var include_change_status_route = "{{ route('admin.paymentgateways.status_update') }}";
</script>
@endpush
