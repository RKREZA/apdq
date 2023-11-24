@extends('admin::layouts.main')

@section('page_title')
    {{ __('user::user.names') }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')
    @include('core::layouts.sticky_page_header', [
        'include_back_url'      => route('dashboard'),
        'include_button'       => [
            '1'       => [
                'url'                   => route('admin.users.create'),
                'text'                  => '',
                'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
                'permission'            => 'user-create',
            ],
        ],
        'include_header'        => __('user::user.names'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.users.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'user-delete',
        ],
    ])

    @include('core::layouts.filter',[
            'include_action'    => route('admin.users.index'),
            'include_method'    => 'GET',
            'include_from'      => 'user',
            'include_fields'    => [
                'status',
            ],
        ]
    )

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.users.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.users.trash_all'),
                            'include_delete_all_permission'     => 'user-delete',
                            'include_index_table_data_route'    => route('admin.users.index'),
                            'filter_ajax_data'                  => 'on',
                            'include_table_rows'                => [
                                'name'              => __('user::user.form.name'),
                                'email'             => __('user::user.form.email'),
                                'mobile'            => __('user::user.form.mobile'),
                                'role'              => __('user::user.form.role'),
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
        var include_change_status_route = "{{ route('admin.users.status_update') }}";
    </script>
@endpush
