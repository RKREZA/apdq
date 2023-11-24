@extends('admin::layouts.main')

@section('page_title')
    {{ __('faq::faq.category.name') }}
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
        'include_back_url'      => route('admin.faqs.index'),
        'include_button'       => [
            '1'       => [
                'url'                   => route('admin.faqcategories.create'),
                'text'                  => '',
                'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
                'permission'            => 'faqcategory-list',
            ],
        ],
        'include_header'        => __('faq::faq.category.name'),
        'include_breadcrumbs'   => [
            route('dashboard')   => __('admin::auth.dashboard'),
            route('admin.faqs.index')   => __('faq::faq.faq.name'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.faqcategories.trashes'),
            'text'                  => __('core::core.form.trash'),
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'faqcategory-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.faqcategories.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.faqcategories.trash_all'),
                            'include_delete_all_permission'     => 'faqcategory-delete',
                            'include_index_table_data_route'    => route('admin.faqcategories.index'),
                            'include_table_rows'                => [
                                'name'          => __('faq::faq.category.form.name'),
                                'code'          => __('faq::faq.category.form.code'),
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
    var include_change_status_route = "{{ route('admin.faqcategories.status_update') }}";
</script>
@endpush
