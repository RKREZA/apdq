@extends('admin::layouts.main')

@section('page_title')
    {{ __('faq::faq.faq.name') }}
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
                'url'                   => route('admin.faqs.create'),
                'text'                  => '',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'faq-create',
            ],
            '2'       => [
                'url'                   => route('admin.faqcategories.index'),
                'text'                  =>__('faq::faq.category.name'),
                'icon'                  => '<i class="fi fi-ss-clipboard-list-check"></i>',
                'permission'            => 'faqcategory-list',
            ],
        ],
        'include_header'        => __('faq::faq.faq.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.faqs.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'faq-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.faqs.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.faqs.trash_all'),
                            'include_delete_all_permission'     => 'faq-delete',
                            'include_index_table_data_route'    => route('admin.faqs.index'),
                            'include_table_rows'                => [
                                'title'          => __('faq::faq.faq.form.title'),
                                'category_id'   => __('faq::faq.faq.form.category_id'),
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
    var include_change_status_route = "{{ route('admin.faqs.status_update') }}";
</script>
@endpush
