@extends('admin::layouts.main')

@section('page_title')
    {{ __('user::permissiongroup.names') }}
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
                'url'                   => route('admin.permissiongroups.create'),
                'text'                  => '',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'permissiongroup-create',
            ],
        ],
        'include_header'        => __('user::permissiongroup.names'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.permissiongroups.delete_all'),
                            'include_trash_all_url'             => route('admin.permissiongroups.delete_all'),
                            'include_delete_all_permission'     => 'permissiongroup-delete',
                            'include_index_table_data_route'    => route('admin.permissiongroups.index'),
                            'include_table_rows'                => [
                                'name'      => __('user::permissiongroup.form.name'),
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

@endpush
