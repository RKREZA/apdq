@extends('admin::layouts.main')

@section('page_title')
    {{ config('app.name', 'AHSRAYAN-2') }} | Media Manager
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endpush

@section('container')
    <div class="row">
        <div class="col-12 px-md-0">


            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                            <h5 class="mb-0"><i class="material-icons">perm_media</i> <span style="position: relative; top:-4px;">Media Manager</span></h5>

                </div>

                <div class="card-body">
                    <div>
                        <div style="min-height: 70vh;" id="fm"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection





@push('js')
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endpush
