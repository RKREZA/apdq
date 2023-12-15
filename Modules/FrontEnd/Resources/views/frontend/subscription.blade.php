@extends('frontend::frontend.layouts.master')

@section('title')
Plan d'abonnement
@endsection
@section('seo')
    <meta name="title" content="Plan d'abonnement">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="Plan d'abonnement" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>
        #subscription_page{
            background-color: #fafafa;
        }
    </style>
@endpush

@section('content')

<section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/live.webp" alt="">
    <div class="content">
        <h1>Plan d'abonnement</h1>
    </div>
</section>
<section id="subscription_page" class="py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            @foreach ($subscriptions as $subscription)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header bg-white">
                        <h4 class="my-0 fw-bold text-center my-3">{{ $subscription->title }}</h4>
                    </div>
                    <div class="card-body text-center p-3 mt-3">

                        <h1 class="card-title pricing-card-title py-3">
                            {{ $subscription->price }}$<small class="text-muted fw-light"> pour {{ $subscription->duration }} {{ $subscription->duration_type }}</small>
                        </h1>

                        {!! $subscription->description !!}

                        <a href="#" type="button" class="w-100 btn btn-lg btn-outline-primary py-3 mt-5">S'abonner</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection


@push('js')

@endpush
