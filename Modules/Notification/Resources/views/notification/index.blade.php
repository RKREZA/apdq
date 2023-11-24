@extends('admin::layouts.main')

@section('page_title')
    {{ __('notification::notification.index.title') }}
@endsection

@push('css')

    <style>
        .table tr td {
            vertical-align: middle;
        }

        .dataTables_wrapper {
            height: calc(100vh - 180px) !important;
        }

    </style>
@endpush

@section('container')

    @include('core::layouts.sticky_page_header', [
        'include_back_url'          => route('dashboard'),
        // 'include_button'       => [
        //     '1'=> [
        //         'url'                   => route('admin.notices.create'),
        //         'text'                  => __('core::core.add_new',['name' => __('notice::notice.name')]),
        //         'img'                   => asset('assets/backend/img/icons/optimized/add.png'),
        //         'permission'            => 'notice-create',
        //     ],
        // ],
        'include_header'        => __('notification::notification.index.title'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ],
        // 'include_trashes'       => [
        //     'url'                   => route('admin.notices.trashes'),
        //     'text'                  => __('core::core.form.trash'),
        //     'img'                   => asset('assets/backend/img/icons/optimized/trash-white.png'),
        //     'permission'            => 'notice-trash',
        // ],
    ])



    {{-- @include('core::layouts.filter',[
        'include_action'    => route('admin.notifications.index'),
        'include_method'    => 'GET',
        'include_from'      => 'notification',
        'include_fields'    => [
            'notification_type',
            'notification_status',
        ],
    ]
    ) --}}


    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body pb-0">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('core::core.form.date') }}</th>
                                    <th>{{ __('notification::notification.form.type') }}</th>
                                    <th>{{ __('core::core.form.status') }}</th>
                                    <th>{{ __('core::core.form.action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if (isset($demandletter_authorization) && count($demandletter_authorization)>0)
                                    @foreach ($demandletter_authorization as $demandletter)
                                        <tr>
                                            <td>{{ date('jS M Y',strtotime($demandletter->created_at)) }}</td>
                                            <td>{{ __('demandletter::demandletter.name') }}</td>
                                            <td><span class="badge badge-danger">Unauthorized</span></td>
                                            <td><a href="{{ route('admin.demandletters.authorization', Crypt::encrypt($demandletter->id)) }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                        </tr>
                                    @endforeach
                                @endif

                                @if (isset($fundallocation_authorization) && count($fundallocation_authorization)>0)
                                    @foreach ($fundallocation_authorization as $fundallocation)
                                        <tr>
                                            <td>{{ date('jS M Y',strtotime($fundallocation->created_at)) }}</td>
                                            <td>{{ __('fundallocation::fundallocation.name') }}</td>
                                            <td><span class="badge badge-danger">Unauthorized</span></td>
                                            <td><a href="{{ route('admin.fundallocations.authorization', Crypt::encrypt($fundallocation->id)) }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                        </tr>
                                    @endforeach
                                @endif

                                @if (isset($progressreport_authorization) && count($progressreport_authorization)>0)
                                    @foreach ($progressreport_authorization as $progressreport)
                                        <tr>
                                            <td>{{ date('jS M Y',strtotime($progressreport->created_at)) }}</td>
                                            <td>{{ __('progressreport::progressreport.name') }}</td>
                                            <td><span class="badge badge-danger">Unauthorized</span></td>
                                            <td><a href="{{ route('admin.progressreports.authorization', Crypt::encrypt($progressreport->id)) }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                        </tr>
                                    @endforeach
                                @endif

                                @if (isset($completionreport_authorization) && count($completionreport_authorization)>0)
                                    @foreach ($completionreport_authorization as $completionreport)
                                        <tr>
                                            <td>{{ date('jS M Y',strtotime($completionreport->created_at)) }}</td>
                                            <td>{{ __('completionreport::completionreport.name') }}</td>
                                            <td><span class="badge badge-danger">Unauthorized</span></td>
                                            <td><a href="{{ route('admin.completionreports.authorization', Crypt::encrypt($completionreport->id)) }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                        </tr>
                                    @endforeach
                                @endif

                                @foreach ($newses as $news)
                                    <tr>
                                        <td>{{ date('jS M Y',strtotime($news->created_at)) }}</td>
                                        <td>{{ __('news::news.name') }}</td>
                                        <td><span class="badge badge-danger">Inactive</span></td>
                                        <td><a href="{{ route('admin.newses.index').'?status='.$news->status }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                    </tr>
                                @endforeach
                                @foreach ($notices as $notice)
                                    <tr>
                                        <td>{{ date('jS M Y',strtotime($notice->created_at)) }}</td>
                                        <td>{{ __('notice::notice.name') }}</td>
                                        <td><span class="badge badge-danger">Inactive</span></td>
                                        <td><a href="{{ route('admin.notices.index').'?status='.$notice->status }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                    </tr>
                                @endforeach
                                @foreach ($publications as $publication)
                                    <tr>
                                        <td>{{ date('jS M Y',strtotime($publication->created_at)) }}</td>
                                        <td>{{ __('publication::publication.name') }}</td>
                                        <td><span class="badge badge-danger">Inactive</span></td>
                                        <td><a href="{{ route('admin.publications.index').'?status='.$publication->status }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                    </tr>
                                @endforeach
                                @foreach ($uploads as $upload)
                                    <tr>
                                        <td>{{ date('jS M Y',strtotime($upload->created_at)) }}</td>
                                        <td>{{ __('upload::upload.upload.name') }}</td>
                                        <td><span class="badge badge-danger">Inactive</span></td>
                                        <td><a href="{{ route('admin.uploads.index',Crypt::encrypt($upload->category_id)).'?status='.$publication->status }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                    </tr>
                                @endforeach
                                @foreach ($projectprofiles as $projectprofile)
                                    <tr>
                                        <td>{{ date('jS M Y',strtotime($projectprofile->created_at)) }}</td>
                                        <td>{{ __('projectprofile::projectprofile.name') }}</td>
                                        <td><span class="badge badge-danger">Inactive</span></td>
                                        <td><a href="{{ route('admin.projectprofiles.index').'?status='.$projectprofile->status }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                    </tr>
                                @endforeach
                                @foreach ($beneficiaries as $beneficiary)
                                    <tr>
                                        <td>{{ date('jS M Y',strtotime($beneficiary->created_at)) }}</td>
                                        <td>{{ __('beneficiary::beneficiary.name') }}</td>
                                        <td><span class="badge badge-danger">Inactive</span></td>
                                        <td><a href="{{ route('admin.beneficiaries.index').'?status='.$beneficiary->status }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                    </tr>
                                @endforeach

                                @foreach ($galleries as $gallery)
                                    <tr>
                                        <td>{{ date('jS M Y',strtotime($gallery->created_at)) }}</td>
                                        <td>{{ __('frontendmanager::gallery.name') }}</td>
                                        <td><span class="badge badge-danger">Inactive</span></td>
                                        <td><a href="{{ route('admin.galleries.index').'?status='.$gallery->status }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                    </tr>
                                @endforeach

                                @foreach ($successstories as $successstory)
                                    <tr>
                                        <td>{{ date('jS M Y',strtotime($successstory->created_at)) }}</td>
                                        <td>{{ __('frontendmanager::successstory.name') }}</td>
                                        <td><span class="badge badge-danger">Inactive</span></td>
                                        <td><a href="{{ route('admin.successstories.index').'?status='.$successstory->status }}" target="_blank" class="btn btn-warning">Take Action</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>

@endsection

@push('js')
    <script>

    </script>
@endpush
