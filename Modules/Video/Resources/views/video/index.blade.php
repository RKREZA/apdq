@extends('admin::layouts.main')

@section('page_title')
    {{ __('video::video.video.name') }}
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
                'url'                   => route('admin.videos.youtube.create'),
                'text'                  => 'Youtube',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'video-list',
            ],
            '2'       => [
                'url'                   => route('admin.videos.manual.create'),
                'text'                  => 'Manual',
                'icon'                  => '<i class="fi fi-ss-add"></i>',
                'permission'            => 'video-list',
            ],
            // '2'       => [
            //     'url'                   => route('admin.videocategories.index'),
            //     'text'                  =>__('video::video.category.name'),
            //     'img'                   => asset('assets/backend/img/icons/optimized/list.png'),
            //     'permission'            => 'videocategory-list',
            // ],
        ],
        'include_header'        => __('video::video.video.name'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        'include_trashes'       => [
            'url'                   => route('admin.videos.trashes'),
            'text'                  => __('core::core.form.trash'),
            'permission'            => 'video-delete',
        ],
    ])

    <div class="row">

        <div class="col-md-12 px-md-0">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        @include('core::layouts.table',[
                            'include_delete_all_url'            => route('admin.videos.force_destroy_all'),
                            'include_trash_all_url'             => route('admin.videos.trash_all'),
                            'include_delete_all_permission'     => 'video-delete',
                            'include_index_table_data_route'    => route('admin.videos.index'),
                            'include_table_rows'                => [
                                'thumbnail_url'     => __('video::video.video.form.thumbnail_url'),
                                'title'             => __('video::video.video.form.title'),
                                'category_id'       => __('video::video.video.form.category_id'),
                                'subcategory_id'    => __('video::video.video.form.subcategory_id'),
                                'playlist_id'       => __('video::video.video.form.playlist_id'),
                                'reaction'          => __('video::video.video.form.reaction'),
                                'created_at'        => __('video::video.video.form.created_at'),
                                'featured'          => __('core::core.form.featured'),
                                'status'            => __('core::core.form.status'),
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
    var include_change_status_route = "{{ route('admin.videos.status_update') }}";
</script>

<script type="text/javascript">
    function changeFeatured(_this, id) {
        var featured = $(_this).prop('checked') == true ? 'Active' : 'Inactive';
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `{{ route('admin.videos.featured_update') }}`,
            type: 'get',
            data: {
                _token: _token,
                id: id,
                featured: featured
            },
            success: function(result) {
                @include('admin::layouts.includes.js.json_response')
            },
        });
    }
</script>
@endpush
