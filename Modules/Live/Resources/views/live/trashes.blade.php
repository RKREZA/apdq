@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.trashes.title',['name' => __('live::live.live.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')
    @include('core::layouts.sticky_page_header', [
        'include_back_url'      => route('admin.lives.index'),
        'include_button'       => [

        ],
        'include_header'        => __('core::core.trashes.title',['name' => __('live::live.live.name')]),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
            route('admin.lives.index')      => __('live::live.live.name'),
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @include('core::layouts.trash_table',[
                            'include_delete_all_url'                => route('admin.lives.force_destroy_all'),
                            'include_restore_all_url'               => route('admin.lives.restore_all'),
                                'include_index_table_data_route'    => route('admin.lives.trashes'),
                                'include_table_rows'                => [
                                    'title'         => __('live::live.live.form.title'),
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
        var include_change_status_route = "{{ route('admin.lives.status_update') }}";
    </script>
@endpush
