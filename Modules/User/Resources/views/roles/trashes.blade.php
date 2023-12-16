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
        'include_back_url'      => route('admin.roles.index'),
        'include_button'       => [ ],
        
        'include_header'        => __('core::core.trashes.title',['name' => __('user::role.name')]),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
            route('admin.roles.index')      => __('user::role.name'),
        ],
        // 'include_trashes'       => [
        //     'url'                   => route('admin.roles.trashes'),
        //     'text'                  => __('core::core.form.trash'),
        //     'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
        //     'role'            => 'role-trash',
        // ],
    ])

    <div class="row">
        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        @include('core::layouts.trash_table',[
                            'include_delete_all_url'            => route('admin.roles.force_destroy_all'),
                            'include_restore_all_url'           => route('admin.roles.restore_all'),
                            'include_index_table_data_route'    => route('admin.roles.trashes'),
                            'include_table_rows'                => [
                                'name'      => __('user::role.form.name'),
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
