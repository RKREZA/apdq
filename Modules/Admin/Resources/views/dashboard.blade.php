@extends('admin::layouts.main')

@section('page_title')
    {{ __('admin::dashboard.title') }}
@endsection

@push('css')
<style>

</style>
@endpush

@section('container')
    @if (isset($announcements) && count($announcements)>0)
        @foreach ($announcements as $announcement)
            <div class="custom_alert">
                <div class="alert alert-{{ strtolower($announcement->type) }}alert-dismissible fade show" role="alert">
                    {!! $announcement->description !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        @endforeach
    @endif

    <div class="row my-5">

        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.videos.index') }}">
                <div class="card rounded-3">
                    <div class="card-header border-0 p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fi fi-ss-play-alt"></i>
                        </div>

                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Videos</p>
                            <h4 class="mb-0">{{ $videos }}</h4>
                        </div>
                    </div>
                    <hr class="horizontal my-0 dark">

                    <div class="card-footer border-0 p-3">
                        <h6 class="mb-0">{{ __('video::video.video.name') }}</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.videos.index') }}">
                <div class="card rounded-3">
                    <div class="card-header border-0 p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fi fi-ss-money-check-edit"></i>
                        </div>

                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Subscription</p>
                            <h4 class="mb-0">{{ $subscriptions }}</h4>
                        </div>
                    </div>
                    <hr class="horizontal my-0 dark">

                    <div class="card-footer border-0 p-3">
                        <h6 class="mb-0">{{ __('subscription::subscription.subscription.name') }}</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.videos.index') }}">
                <div class="card rounded-3">
                    <div class="card-header border-0 p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fi fi-ss-envelope-download"></i>
                        </div>

                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Emails</p>
                            <h4 class="mb-0">{{ $newsletters }}</h4>
                        </div>
                    </div>
                    <hr class="horizontal my-0 dark">

                    <div class="card-footer border-0 p-3">
                        <h6 class="mb-0">{{ __('newsletter::newsletter.newsletter.name') }}</h6>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.videos.index') }}">
                <div class="card rounded-3">
                    <div class="card-header border-0 p-3 pt-2">
                        <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="fi fi-ss-message-dollar"></i>
                        </div>

                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Amount</p>
                            <h4 class="mb-0">{{ $transactions }}</h4>
                        </div>
                    </div>
                    <hr class="horizontal my-0 dark">

                    <div class="card-footer border-0 p-3">
                        <h6 class="mb-0">{{ __('transaction::transaction.transaction.name') }}</h6>
                    </div>
                </div>
            </a>
        </div>

    </div>


@endsection


@push('js')

@endpush
