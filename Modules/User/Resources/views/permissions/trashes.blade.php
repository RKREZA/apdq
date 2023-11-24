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
        'include_back_url'      => route('admin.permissions.index'),
        'include_button'       => [

        ],
        'include_header'        => __('core::core.trashes.title',['name' => __('user::permission.name')]),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
            route('admin.permissions.index')      => __('user::permission.name'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.permissions.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'permission-trash',
        ],
    ])

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        @include('core::layouts.trash_table',[
                            'include_delete_all_url'            => route('admin.permissions.force_destroy_all'),
                            'include_restore_all_url'           => route('admin.permissions.restore_all'),
                            'include_index_table_data_route'    => route('admin.permissions.trashes'),
                            'include_table_rows'                => [
                                'name'      => __('user::permission.form.name'),
                                'permissiongroup_id'     => __('user::permission.form.permissiongroup_id'),
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
