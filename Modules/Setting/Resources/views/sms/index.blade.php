@extends('admin::layouts.main')

@section('page_title')
    {{ __('setting::sms.index.title') }}
@endsection

@push('css')


    <style>
        .table tr td {
            vertical-align: middle;
        }

    </style>

@endpush

@section('container')

    <div class="mb-2 shadow-blur border-radius-xl z-index-sticky">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body py-3 px-4">
                        <div class="row">
                            <div class="col-md-8">

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                                        <li class="breadcrumb-item text-xs"><a class="opacity-5 text-dark"
                                                href="{{ route('dashboard') }}">{{ __('admin::auth.dashboard') }}</a></li>
                                        <li class="breadcrumb-item text-xs text-dark active" aria-current="page">{{ __('setting::sms.index.title') }}
                                        </li>
                                    </ol>
                                </nav>

                                <h6 class="font-weight-bolder mb-0">
                                    {{ __('setting::sms.index.title') }}
                                </h6>

                            </div>

                            <div class="col-md-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row mb-2">
        <div class="col-lg-3">
            <div class="card position-sticky top-2">
                <ul class="nav flex-column bg-white border-radius-lg p-3">

                    <li class="nav-item">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#sms_setting">
                            <i class="material-icons text-lg me-2">smartphone</i>
                            <span class="text-sm">{{ __('setting::sms.form.tab_sms_setting') }}</span>
                        </a>
                    </li>

                    {{-- <hr class="horizontal light">

                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#sms_template">
                            <i class="material-icons text-lg me-2">wysiwyg</i>
                            <span class="text-sm">{{ __('setting::sms.form.tab_sms_template') }}</span>
                        </a>
                    </li>

                    <hr class="horizontal light">

                    <li class="nav-item pt-2">
                        <a class="nav-link text-dark d-flex" data-scroll="" href="#sms_history">
                            <i class="material-icons text-lg me-2">history</i>
                            <span class="text-sm">{{ __('setting::sms.form.tab_sms_history') }}</span>
                        </a>
                    </li> --}}

                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-lg-0 mt-2">

            <!-- SMS Setting -->
            <div class="card" id="sms_setting">
                <div class="card-header">
                    <h6 class="m-0">{{ __('setting::sms.form.tab_sms_setting') }}</h6>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('admin.setting.smssettings.sms_setting') }}" id="">
                        @csrf()
                        <div class="row">
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.sms_username')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::sms.form.sms_username') }}</label>
                                    <input type="text" name="sms_username" class="form-control" value="{{ config('app.sms_username') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.sms_password')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::sms.form.sms_password') }}</label>
                                    <input type="text" name="sms_password" class="form-control" value="{{ config('app.sms_password') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.sms_api_key')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::sms.form.sms_api_key') }}</label>
                                    <input type="text" name="sms_api_key" class="form-control" value="{{ config('app.sms_api_key') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.sms_acode')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::sms.form.sms_acode') }}</label>
                                    <input type="text" name="sms_acode" class="form-control" value="{{ config('app.sms_acode') }}">
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.sms_masking')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::sms.form.sms_masking') }}</label>
                                    <input type="text" name="sms_masking" class="form-control" value="{{ config('app.sms_masking') }}">
                                </div>
                            </div>

                            <div class="col-md-6 mt-4">
                                <div class="input-group input-group-outline is-filled @if (config('app.sms_is_unicode')) is-valid @endif">
                                    <label class="form-label">{{ __('setting::sms.form.sms_is_unicode') }}</label>
                                    <input type="text" name="sms_is_unicode" class="form-control" value="{{ config('app.sms_is_unicode') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="create-button btn btn-dark btn-rounded btn-md float-end mt-4 mb-0"><i class="material-icons text-sm me-2">sync</i>{{ __('setting::sms.form.update_sms_setting_button') }}</button>
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

{{-- Js Validation for Form --}}
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
