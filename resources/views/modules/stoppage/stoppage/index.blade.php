@extends('admin::layouts.main')

@section('page_title')
    {{ __('stoppage::stoppage.names') }}
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
                'url'                   => route('admin.stoppages.create'),
                'text'                  => '',
                'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
                'permission'            => 'stoppage-create',
            ],
        ],
        'include_header'        => __('stoppage::stoppage.names'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.stoppages.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'stoppage-delete',
        ],
    ])

    {{-- @include('core::layouts.filter',[
            'include_action'    => route('admin.stoppages.index'),
            'include_method'    => 'GET',
            'include_from'      => 'stoppage',
            'include_fields'    => [
                'department_id',
                'division_id',
                'district_id',
                'subdistrict_id',
                'status',
            ],
        ]
    ) --}}

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.stoppages.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.stoppages.trash_all'),
                            'include_delete_all_permission'     => 'stoppage-delete',
                            'include_index_table_data_route'    => route('admin.stoppages.index'),
                            'filter_ajax_data'                  => 'on',
                            'include_table_rows'                => [
                                'photo'             => __('core::core.form.photo'),
                                'name'              => __('stoppage::stoppage.form.name'),
                                'lat'               => __('stoppage::stoppage.form.lat'),
                                'lon'               => __('stoppage::stoppage.form.lon'),
                                'city_id'           => __('stoppage::stoppage.form.city_id'),
                                'country_id'        => __('stoppage::stoppage.form.country_id'),
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
        var include_change_status_route = "{{ route('admin.stoppages.status_update') }}";
    </script>
@endpush
