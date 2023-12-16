@extends('admin::layouts.main')

@section('page_title')
    {{ __('language::language.name') }}
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
                'url'                   => route('admin.setting.languages.create'),
                'text'                  => '',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'language-create',
            ]
        ],

        'include_header'        => __('language::language.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.setting.languages.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'language-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.setting.languages.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.setting.languages.trash_all'),
                            'include_delete_all_permission'     => 'language-delete',
                            'include_index_table_data_route'    => route('admin.setting.languages.index'),
                            'include_table_rows'                => [
                                'code'      => __('language::language.form.code'),
                                'name'      => __('language::language.form.name'),
                                'status'    => __('core::core.form.status'),
                                'default'   => __('core::core.form.default'),
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
    var include_change_status_route = "{{ route('admin.setting.languages.status_update') }}";
    var include_change_default_route = "{{ route('admin.setting.languages.default_update') }}";
</script>

@endpush
