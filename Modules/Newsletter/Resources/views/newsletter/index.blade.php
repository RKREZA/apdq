@extends('admin::layouts.main')

@section('page_title')
    {{ __('newsletter::newsletter.newsletter.name') }}
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
                'url'                   => route('admin.newsletters.create'),
                'text'                  => '',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'newsletter-create',
            ],
        ],
        'include_header'        => __('newsletter::newsletter.newsletter.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.newsletters.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'newsletter-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.newsletters.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.newsletters.trash_all'),
                            'include_delete_all_permission'     => 'newsletter-delete',
                            'include_index_table_data_route'    => route('admin.newsletters.index'),
                            'include_table_rows'                => [
                                'email'             => __('newsletter::newsletter.newsletter.form.email'),
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
    var include_change_status_route = "{{ route('admin.newsletters.status_update') }}";
</script>
@endpush
