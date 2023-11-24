@extends('admin::layouts.main')

@section('page_title')
    {{ __('setting::backup.index.title') }}
@endsection

@push('css')

    <style>
        .table tr td {
            vertical-align: middle;
        }

    </style>
@endpush

@section('container')


    <div class="position-sticky top-0 mb-2 shadow-blur border-radius-xl z-index-sticky">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body py-3 px-4">
                        <div class="row">
                            <div class="col-md-6">

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                                        <li class="breadcrumb-item text-xs"><a class="opacity-5 text-dark" href="{{ route('dashboard') }}">{{ __('admin::auth.dashboard') }}</a></li>
                                        <li class="breadcrumb-item text-xs text-dark active" aria-current="page">{{ __('setting::backup.index.title') }}</li>
                                    </ol>
                                </nav>

                                <h6 class="font-weight-bolder mb-0">{{ __('setting::backup.index.title') }}</h6>

                            </div>

                            <div class="col-md-6">
                                @can('backup-clean')
                                    <button class="create-button btn btn-dark btn-rounded mt-1 my-0 mx-1 float-end" onclick="clean_backup(event.target)">
                                        <i class="material-icons me-sm-1">cleaning_services</i>{{ __('setting::backup.form.clean') }}
                                    </button>
                                @endcan

                                @can('backup-monitor')
                                    <button class="create-button btn btn-dark btn-rounded mt-1 my-0 mx-1 float-end" onclick="monitor_backup(event.target)">
                                        <i class="material-icons me-sm-1">monitor_heart</i>{{ __('setting::backup.form.monitor') }}
                                    </button>
                                @endcan

                                @can('backup-create')
                                    <button class="create-button btn btn-dark btn-rounded mt-1 my-0 mx-1 float-end" onclick="create_backup(event.target)">
                                        <i class="material-icons me-sm-1">backup</i>{{ __('setting::backup.form.create') }}
                                    </button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-center mb-0" id="table">
                            <thead>
                                <tr>
                                    <th class="">{{ __('setting::backup.form.name') }}</th>
                                    <th class="">{{ __('setting::backup.form.size') }}</th>
                                    <th class="">{{ __('setting::backup.form.date') }}</th>
                                    <th class="">{{ __('setting::backup.form.age') }}</th>

                                    @if (Gate::check('backup-download') || Gate::check('backup-delete'))
                                        <th class="">{{ __('setting::backup.form.action') }}</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($backups as $backup)
                                    <tr>
                                        <td>{{ $backup['file_name'] }}</td>
                                        <td>{{ \Modules\Setting\Http\Controllers\BackupController::humanFilesize($backup['file_size']) }}</td>
                                        <td>
                                            {{ date('jS M, Y, h:ia',$backup['last_modified']) }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($backup['last_modified'])->diffForHumans() }}
                                        </td>

                                        @if (Gate::check('backup-download') || Gate::check('backup-delete'))
                                            <td class="text-right">
                                                <a class="btn btn-sm btn-dark mb-0" href="{{ route('admin.setting.backup.download', $backup['file_name']) }}">
                                                    <i class="material-icons text-sm">download</i>
                                                    {{ __('setting::backup.form.download') }}
                                                </a>

                                                <button class="create-button btn btn-danger btn-sm mb-0 remove-backup" data-id="{{ $backup['file_name'] }}" data-action="{{ route('admin.setting.backup.delete', $backup['file_name']) }}">
                                                    <i class="material-icons text-sm">delete</i>
                                                </button>
                                            </td>
                                        @endif
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
    $(function() {
        $('#table').DataTable({
            @include('admin::layouts.includes.js.json_datatable')

            processing: true,
            responsive: false,

        });
    });
</script>

<script type="text/javascript">
    $("body").on("click", ".remove-backup", function() {
        var current_object = $(this);
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "error",
            showCancelButton: true,
            dangerMode: true,
            cancelButtonClass: '#DD6B55',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Delete!',
        }, function(result) {
            if (result) {
                var action = current_object.attr('data-action');
                var token = jQuery('meta[name="csrf-token"]').attr('content');
                var id = current_object.attr('data-id');

                $('body').html("<form class='form-inline remove-form' method='POST' action='" + action +
                    "'></form>");
                $('body').find('.remove-form').append(
                    '<input name="_method" type="hidden" value="post">');
                $('body').find('.remove-form').append('<input name="_token" type="hidden" value="' +
                    token + '">');
                $('body').find('.remove-form').append('<input name="id" type="hidden" value="' + id +
                    '">');
                $('body').find('.remove-form').submit();
            }
        });
    });
</script>


<script type="text/javascript">
    function create_backup(_this) {
        iziToast.warning({
            title: '',
            message: 'Processing! Please wait. Don\'t reload your browser. It will take 3-4 minutes',
            timeout: 50000,
        });

        window.onbeforeunload = confirmExit;
        function confirmExit() {
            return "You have attempted to leave this page. Are you sure?";
        }

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `{{ route('admin.setting.backup.create') }}`,
            type: 'get',
            data: {
                _token: _token
            },
            success: function(result) {
                @include('admin::layouts.includes.js.json_response')
                setTimeout(function(){
                    location.reload();
                }, 5000);
            },


        });
    }

    function clean_backup(_this) {
        iziToast.warning({
            title: '',
            message: 'Processing! Please wait. Don\'t reload your browser. It will take 3-4 minutes',
            timeout: 50000,
        });

        window.onbeforeunload = confirmExit;
        function confirmExit() {
            return "You have attempted to leave this page. Are you sure?";
        }

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `{{ route('admin.setting.backup.clean') }}`,
            type: 'get',
            data: {
                _token: _token
            },
            success: function(result) {
                @include('admin::layouts.includes.js.json_response')
                setTimeout(function(){
                    location.reload();
                }, 5000);
            },


        });
    }

    function monitor_backup(_this) {
        iziToast.warning({
            title: '',
            message: 'Processing! Please wait. Don\'t reload your browser. It will take 3-4 minutes',
            timeout: 50000,
        });

        window.onbeforeunload = confirmExit;
        function confirmExit() {
            return "You have attempted to leave this page. Are you sure?";
        }

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `{{ route('admin.setting.backup.monitor') }}`,
            type: 'get',
            data: {
                _token: _token
            },
            success: function(result) {
                @include('admin::layouts.includes.js.json_response')
                setTimeout(function(){
                    location.reload();
                }, 5000);
            },


        });
    }
</script>

@endpush
