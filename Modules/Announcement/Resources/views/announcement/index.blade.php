@extends('admin::layouts.main')

@section('page_title')
    {{ __('announcement::announcement.name') }}
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
            '1'       => [
                'url'                   => route('admin.announcements.create'),
                'text'                  => '',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'announcement-create',
            ],
        ],
        'include_header'        => __('announcement::announcement.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.announcements.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'announcement-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.announcements.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.announcements.trash_all'),
                            'include_delete_all_permission'     => 'announcement-delete',
                            'include_index_table_data_route'    => route('admin.announcements.index'),
                            'include_table_rows'                => [
                                'description'          => __('announcement::announcement.form.description'),
                                'type'          => __('announcement::announcement.form.type'),
                                'public'        => __('announcement::announcement.form.public'),
                                'blink'         => __('announcement::announcement.form.blink'),
                                'status'        => __('core::core.form.status'),
                                'action'        => __('core::core.form.action'),
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
    var include_change_status_route = "{{ route('admin.announcements.status_update') }}";
</script>
@endpush
