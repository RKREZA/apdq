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

    <div class="row">
        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.videos.index') }}">
                <div class="card">
                    <div class="card-body text-center p-4">
                        <img src="{{ asset('assets/backend/img/icons/optimized/video-black.png') }}" class="dashboard-icon mt-2" alt="">
                        <h4 class="h5 mt-2 p-0"> {{ __('video::video.video.name') }}</h4>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.lives.index') }}">
                <div class="card">
                    <div class="card-body text-center p-4">
                        <img src="{{ asset('assets/backend/img/icons/optimized/live-black.png') }}" class="dashboard-icon mt-2" alt="">
                        <h4 class="h5 mt-2 p-0"> {{ __('live::live.live.name') }}</h4>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.subscriptions.index') }}">
                <div class="card">
                    <div class="card-body text-center p-4">
                        <img src="{{ asset('assets/backend/img/icons/optimized/subscription-black.png') }}" class="dashboard-icon mt-2" alt="">
                        <h4 class="h5 mt-2 p-0"> {{ __('subscription::subscription.subscription.name') }}</h4>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.newsletters.index') }}">
                <div class="card">
                    <div class="card-body text-center p-4">
                        <img src="{{ asset('assets/backend/img/icons/optimized/email-black.png') }}" class="dashboard-icon mt-2" alt="">
                        <h4 class="h5 mt-2 p-0"> {{ __('newsletter::newsletter.newsletter.name') }}</h4>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.posts.index') }}">
                <div class="card">
                    <div class="card-body text-center p-4">
                        <img src="{{ asset('assets/backend/img/icons/optimized/blog-black.png') }}" class="dashboard-icon mt-2" alt="">
                        <h4 class="h5 mt-2 p-0"> {{ __('blog::blog.post.name') }}</h4>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.paymentgateways.index') }}">
                <div class="card">
                    <div class="card-body text-center p-4">
                        <img src="{{ asset('assets/backend/img/icons/optimized/paymentgateway-black.png') }}" class="dashboard-icon mt-2" alt="">
                        <h4 class="h5 mt-2 p-0"> {{ __('paymentgateway::paymentgateway.paymentgateway.name') }}</h4>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.transactions.index') }}">
                <div class="card">
                    <div class="card-body text-center p-4">
                        <img src="{{ asset('assets/backend/img/icons/optimized/transaction-black.png') }}" class="dashboard-icon mt-2" alt="">
                        <h4 class="h5 mt-2 p-0"> {{ __('transaction::transaction.transaction.name') }}</h4>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-3 mb-2">
            <a href="{{ route('admin.users.index') }}">
                <div class="card">
                    <div class="card-body text-center p-4">
                        <img src="{{ asset('assets/backend/img/icons/optimized/user-black.png') }}" class="dashboard-icon mt-2" alt="">
                        <h4 class="h5 mt-2 p-0"> {{ __('user::user.user') }}</h4>
                    </div>
                </div>
            </a>
        </div>
        
    </div>


@endsection


@push('js')

@endpush
