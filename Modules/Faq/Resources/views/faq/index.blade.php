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
                'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
                'permission'            => 'faq-list',
            ],
            '2'       => [
                'url'                   => route('admin.faqcategories.index'),
                'text'                  =>__('faq::faq.category.name'),
                'img'                   => asset('assets/backend/img/icons/optimized/list.png'),
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
            'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
            'permission'            => 'faq-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12">
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
                                'description'    => __('faq::faq.faq.form.description'),
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
