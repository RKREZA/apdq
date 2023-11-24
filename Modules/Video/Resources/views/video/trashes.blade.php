@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.trashes.title',['name' => __('video::video.video.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')
    @include('core::layouts.sticky_page_header', [
        'include_back_url'      => route('admin.videos.index'),
        'include_button'       => [

        ],
        'include_header'        => __('core::core.trashes.title',['name' => __('video::video.video.name')]),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
            route('admin.videos.index')      => __('video::video.video.name'),
        ],
    ])

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @include('core::layouts.trash_table',[
                            'include_delete_all_url'                => route('admin.videos.force_destroy_all'),
                            'include_restore_all_url'               => route('admin.videos.restore_all'),
                                'include_index_table_data_route'    => route('admin.videos.trashes'),
                                'include_table_rows'                => [
                                    'title'         => __('video::video.video.form.title'),
                                    'description'   => __('video::video.video.form.description'),
                                    'category_id'   => __('video::video.video.form.category_id'),
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
        var include_change_status_route = "{{ route('admin.videos.status_update') }}";
    </script>
@endpush
