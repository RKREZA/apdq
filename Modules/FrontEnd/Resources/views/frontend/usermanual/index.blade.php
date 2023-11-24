@extends('frontend::frontend.layouts.master')

@section('title')
{{ __('frontendmanager::home.usermanual.title') }}
@endsection

@push('css')

    <link href="{{ asset('backend_assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

    <style>
        .table tr td {
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')

    <section class="breadcrumb-area">
        <div class="container">
            <div class="bg-white p-3">
                <div class="breadcrumb_navigation">
                    <ul>
                        <li><a href="/">{{ __('frontendmanager::home.beneficiary.home') }}</a></li>
                        <li class="active">{{ __('frontendmanager::home.usermanual.title') }}</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="content-text text_white">
                            <h5 class="h5">{{ __('frontendmanager::home.usermanual.title') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-area">
        <div class="container">
            <div class="bg-white p-3 pb-5">

                {{-- <div class="table-responsive"> --}}
                    <table class="table table-hover table-center" id="table">
                        <thead style="">
                            <tr>
                                <th class="">{{ __('frontendmanager::home.usermanual.file_title') }}</th>
                                <th class="">{{ __('core::core.form.download') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documentations as $documentation)
                                <tr>
                                    <td>
                                        @php
                                            if(strlen($documentation->title) > 150){
                                                echo substr($documentation->title,0,150).'...';
                                            }else{
                                                echo $documentation->title;
                                            }
                                        @endphp
                                    </td>
                                    <td>
                                        @foreach ($documentation->files as $file)
                                            <a href="{{ $file->path }}"  title="{{ $file->name }}" target="__tab" class="edit btn btn-primary">{{ __('core::core.form.download') }}</a>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                {{-- </div> --}}
            </div>
        </div>
    </section>

@endsection


@push('js')

<link href="{{ asset('backend_assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" />
<script src="{{ asset('backend_assets/js/plugins/jquery.dataTables.min.js') }}"></script>

<script>
    $(function() {

        $('#table').DataTable({
            @include('admin::layouts.includes.js.json_datatable')

            processing: true,
            responsive: false,
            serverSide: false,
        });
    });
</script>
@endpush
