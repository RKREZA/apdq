@extends('admin::layouts.main')

@section('page_title')
    {{ config('app.name', 'BUZZGARI') }} | {{ __('admin::dashboard.title') }}
@endsection

@push('css')
<style>

</style>
@endpush

@section('container')
    @if (isset($announcements) && count($announcements)>0)
        @foreach ($announcements as $announcement)
            <div class="custom_alert">
                <div class="alert alert-{{ strtolower($announcement->type) }} alert-dismissible fade show" role="alert">
                    {!! $announcement->description !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        @endforeach
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body" style="min-height: 80vh;">

                </div>
            </div>
        </div>
    </div>


@endsection


@push('js')

@endpush
