@extends('admin::layouts.main')

@section('page_title')
    {{ __('newsletter::newsletter.category.name') }}
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
        'include_back_url'      => route('admin.newsletters.index'),
        'include_button'       => [
            '1'       => [
                'url'                   => route('admin.newslettercategories.create'),
                'text'                  => '',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'newslettercategory-create',
            ],
        ],
        'include_header'        => __('newsletter::newsletter.category.name'),
        'include_breadcrumbs'   => [
            route('dashboard')   => __('admin::auth.dashboard'),
            route('admin.newsletters.index')   => __('newsletter::newsletter.newsletter.name'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.newslettercategories.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'newslettercategory-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.newslettercategories.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.newslettercategories.trash_all'),
                            'include_delete_all_permission'     => 'newslettercategory-delete',
                            'include_index_table_data_route'    => route('admin.newslettercategories.index'),
                            'include_table_rows'                => [
                                'serial'          => __('newsletter::newsletter.category.form.serial'),
                                'name'          => __('newsletter::newsletter.category.form.name'),
                                'code'          => __('newsletter::newsletter.category.form.code'),
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
    var include_change_status_route = "{{ route('admin.newslettercategories.status_update') }}";
</script>
@endpush
