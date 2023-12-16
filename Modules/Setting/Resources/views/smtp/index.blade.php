@extends('admin::layouts.main')

@section('page_title')
    {{ __('setting::smtp.index.title') }}
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
        'include_header'        => __('setting::smtp.index.title'),
        'include_breadcrumbs'   => [
            route('dashboard')      => __('admin::auth.dashboard'),
        ]
    ])

    <div class="row mb-2">
        <div class="col-lg-3 ps-md-0">
            <div class="card position-sticky top-2">
                <ul class="nav flex-column bg-white border-radius-lg p-3">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#email_setting">
                            <i class="material-icons text-lg me-2">email</i>
                            <span class="text-sm">{{ __('setting::smtp.form.tab_email_setting') }}</span>
                        </a>
                    </li>

                    {{-- <hr class="horizontal light"> --}}

                    {{-- <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#email_template">
                            <i class="material-icons text-lg me-2">description</i>
                            <span class="text-sm">{{ __('setting::smtp.form.tab_email_template') }}</span>
                        </a>
                    </li>

                    <hr class="horizontal light">

                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#email_history">
                            <i class="material-icons text-lg me-2">history</i>
                            <span class="text-sm">{{ __('setting::smtp.form.tab_email_history') }}</span>
                        </a>
                    </li> --}}

                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-2 mt-lg-0 pe-md-0">

            <!-- Email Setting -->
            <div class="card" id="email_setting">
                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::smtp.form.tab_email_setting') }}</h6>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('admin.setting.smtpsettings.update') }}" id="">
                        @csrf()
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.mail_mailer')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::smtp.form.mail_mailer') }}</label>
                                    <input type="text" name="mail_mailer" class="form-control" value="{{ config('app.mail_mailer') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.mail_host')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::smtp.form.mail_host') }}</label>
                                    <input type="text" name="mail_host" class="form-control" value="{{ config('app.mail_host') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.mail_port')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::smtp.form.mail_port') }}</label>
                                    <input type="text" name="mail_port" class="form-control" value="{{ config('app.mail_port') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.mail_username')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::smtp.form.mail_username') }}</label>
                                    <input type="text" name="mail_username" class="form-control" value="{{ config('app.mail_username') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.mail_password')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::smtp.form.mail_password') }}</label>
                                    <input type="text" name="mail_password" class="form-control" value="{{ config('app.mail_password') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.mail_from_address')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::smtp.form.mail_from_address') }}</label>
                                    <input type="text" name="mail_from_address" class="form-control" value="{{ config('app.mail_from_address') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.mail_encryption')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::smtp.form.mail_encryption') }}</label>
                                    <input type="text" name="mail_encryption" class="form-control" value="{{ config('app.mail_encryption') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.mail_from_name')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::smtp.form.mail_from_name') }}</label>
                                    <input type="text" name="mail_from_name" class="form-control" value="{{ config('app.mail_from_name') }}">
                                </div>
                            </div>



                            <div class="form-group">
                                <button class="create-button btn btn-dark btn-rounded btn-md float-end mt-4 mb-0"><i class="material-icons text-sm me-2">sync</i>{{ __('setting::smtp.form.update_email_setting_button') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


@endsection

@push('js')

<script>
    tinymce.init({
	      selector: '#description',

	      browser_spellcheck : true,
	      paste_data_images: false,

	      responsive: true,

	      plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste imagetools",
                "autosave codesample directionality wordcount"
            ],

            toolbar: "restoredraft insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imagetools media| fullscreen preview code | codesample charmap ltr rtl",

            content_style: 'body { font-family:Poppins",sans-serif;}',

            imagetools_toolbar: "imageoptions",

            file_picker_callback (callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight

                tinymce.activeEditor.windowManager.openUrl({
                url : '/file-manager/tinymce5',
                title : 'File manager',
                width : x * 0.6,
                height : y * 0.9,
                onMessage: (api, message) => {
                    callback(message.content, { text: message.text })
                }
                })
            }
	    });
</script>

<script>
    $(function() {


        $('#table').DataTable({
            @include('admin::layouts.includes.js.json_datatable')

            processing: true,
            responsive: false,
            serverSide: true,
            // order: [
            //     [0, 'desc']
            // ],
            ajax: '{{ route('admin.setting.smtpsettings.index') }}',
            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'email_subject',
                    name: 'email_subject'
                },
                {
                    data: 'email_to',
                    name: 'email_to'
                },
                {
                    data: 'email_cc',
                    name: 'email_cc'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
            ],

        });
    });
</script>

<script type="text/javascript">
    function configcache() {
        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `{{ route('admin.artisan.optimize') }}`,
            type: 'get',
            data: {
                _token: _token,
            },
            success: function(result) {
                @include('admin::layouts.includes.js.json_response')
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        $('select').select2();
    });
</script>
@endpush
