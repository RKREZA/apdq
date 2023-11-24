@extends('admin::layouts.main')

@section('page_title')
    {{ __('user::role.names') }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'      => route('dashboard'),
        'include_button'        => [
            '1'       => [
                'url'                   => route('admin.roles.create'),
                'text'                  => '',
                'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
                'permission'            => 'role-create',
            ]
        ],

        'include_header'        => __('user::role.names'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.roles.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'role-delete',
        ],
    ])

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.roles.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.roles.trash_all'),
                            'include_delete_all_permission'     => 'role-delete',
                            'include_index_table_data_route'    => route('admin.roles.index'),
                            'include_table_rows'                => [
                                'name'      => __('user::role.form.name'),
                                // 'two_fa'      => __('user::role.form.two_fa'),
                                'action'    => __('core::core.form.action'),
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
    var include_change_status_route = "{{ route('admin.roles.status_update') }}";
</script>
@endpush
