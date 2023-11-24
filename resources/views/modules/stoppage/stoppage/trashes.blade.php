@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.trashes.title',['name' => __('stoppage::stoppage.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')
    @include('core::layouts.sticky_page_header', [
        'include_back_url'      => route('admin.stoppages.index'),
        'include_button'       => [
            // '1'       => [
            //     'url'                   => route('admin.stoppages.create'),
            //     'text'                  => '',
            //     'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
            //     'permission'            => 'stoppage-create',
            // ],
        ],
        'include_header'        => __('core::core.trashes.title',['name' => __('stoppage::stoppage.name')]),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        // 'include_trashes'       => [
        //     'url'                   => route('admin.stoppages.trashes'),
        //     'text'                  => __('core::core.form.trash'),
        //     'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
        //     'permission'            => 'stoppage-delete',
        // ],
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
                        @include('core::layouts.trash_table',[
                            'include_delete_all_url'            => route('admin.stoppages.force_destroy_all'),
                            'include_restore_all_url'           => route('admin.stoppages.restore_all'),
                            'include_index_table_data_route'    => route('admin.stoppages.trashes'),
                            'filter_ajax_data'                  => 'on',
                            'include_table_rows'                => [
                                'photo'                 => __('core::core.form.photo'),
                                'name'                  => __('stoppage::stoppage.form.name'),
                                'lat'                   => __('stoppage::stoppage.form.lat'),
                                'lon'                   => __('stoppage::stoppage.form.lon'),
                                'city_id'               => __('stoppage::stoppage.form.city_id'),
                                'country_id'            => __('stoppage::stoppage.form.country_id'),
                                'status'                => __('core::core.form.status'),
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
    <script>
        // Change Status
        var include_change_status_route = "{{ route('admin.stoppages.status_update') }}";
    </script>
@endpush
