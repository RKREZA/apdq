@extends('admin::layouts.main')

@section('page_title')
    {{ __('user::permission.names') }}
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
                'url'                   => route('admin.permissions.create'),
                'text'                  => '',
                'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
                'permission'            => 'permission-create',
            ],
            '2'       => [
                'url'                   => route('admin.permissiongroups.index'),
                'text'                  => __('user::permissiongroup.name'),
                'img'                   => asset('assets/backend/img/icons/optimized/list.png'),
                'permission'            => 'permissiongroup-list',
            ]
        ],

        'include_header'        => __('user::permission.names'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.permissions.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'permission-delete',
        ],
    ])

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.permissions.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.permissions.trash_all'),
                            'include_delete_all_permission'     => 'permission-delete',
                            'include_index_table_data_route'    => route('admin.permissions.index'),
                            'include_table_rows'                => [
                                'nice_name'             => __('user::permission.form.nice_name'),
                                'name'                  => __('user::permission.form.name'),
                                'permissiongroup_id'    => __('user::permission.form.permissiongroup_id'),
                                'action'                => __('core::core.form.action'),
                            ],
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')

@endpush
