@extends('admin::layouts.main')

@section('page_title')
    {{ __('live::live.live.name') }}
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
                'url'                   => route('admin.lives.create'),
                'text'                  => '',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'live-create',
            ],
        ],
        'include_header'        => __('live::live.live.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.lives.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'live-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.lives.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.lives.trash_all'),
                            'include_delete_all_permission'     => 'live-delete',
                            'include_index_table_data_route'    => route('admin.lives.index'),
                            'include_table_rows'                => [
                                'thumbnail_url'     => __('live::live.live.form.thumbnail_url'),
                                'title'             => __('live::live.live.form.title'),
                                'archive'           => __('core::core.form.archive'),
                                'status'            => __('core::core.form.status'),
                                'created_at'        => __('core::core.form.created_at'),
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
    var include_change_status_route = "{{ route('admin.lives.status_update') }}";
</script>

<script type="text/javascript">
    function changeArchive(_this, id) {
        var archive = $(_this).prop('checked') == true ? 'Active' : 'Inactive';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `{{ route('admin.lives.archive_update') }}`,
            type: 'get',
            data: {
                _token: _token,
                id: id,
                archive: archive
            },
            success: function(result) {
                @include('admin::layouts.includes.js.json_response')
            },
        });
    }
</script>
@endpush
