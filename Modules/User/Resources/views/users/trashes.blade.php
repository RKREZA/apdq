@extends('admin::layouts.main')

@section('page_title')
    {{ __('core::core.trashes.title',['name' => __('user::user.name')]) }}
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('container')
    @include('core::layouts.sticky_page_header', [
        'include_back_url'      => route('admin.users.index'),
        'include_button'       => [

        ],
        'include_header'        => __('core::core.trashes.title',['name' => __('user::user.name')]),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
            route('admin.users.index')      => __('user::user.name'),
        ],
    ])

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        @include('core::layouts.trash_table',[
                            'include_delete_all_url'                => route('admin.users.force_destroy_all'),
                            'include_restore_all_url'               => route('admin.users.restore_all'),
                                'include_index_table_data_route'    => route('admin.users.trashes'),
                                'include_table_rows'                => [
                                    'photo'     => __('core::core.form.photo'),
                                    'name'      => __('user::user.form.name'),
                                    'email'     => __('user::user.form.email'),
                                    'mobile'    => __('user::user.form.mobile'),
                                    'role'      => __('user::user.form.role'),
                                    'status'    => __('core::core.form.status'),
                                    'action'    => __('core::core.form.action'),
                                ],
                            ])
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-md-12 my-3">

            <div class="accordion" id="accordionExample">
                <div class="accordion-item card">
                    <div class="card-header p-0">
                        <h2 class="accordion-header p-0" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <h6 class="p-0 m-0">{{ __('core::core.form.trash') }}</h6>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="card-body bg-white accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">

                        <div class="table-responsive">
                            @include('core::layouts.trash_table',[
                                'include_delete_all_url'            => route('admin.users.delete_all'),
                                'include_trash_all_url'             => route('admin.users.delete_all'),
                                'include_index_table_data_route'    => route('admin.users.trashes'),
                                'include_table_rows'                => [
                                    'photo'     => __('core::core.form.photo'),
                                    'name'      => __('user::user.form.name'),
                                    'email'     => __('user::user.form.email'),
                                    'mobile'    => __('user::user.form.mobile'),
                                    'role'      => __('user::user.form.role'),
                                    'status'    => __('core::core.form.status'),
                                    'action'    => __('core::core.form.action'),
                                ],
                            ])
                        </div>

                    </div>
                </div>
            </div>

        </div> --}}
    </div>
@endsection

@push('js')
    <script>
        // Change Status
        var include_change_status_route = "{{ route('admin.users.status_update') }}";
    </script>
@endpush
