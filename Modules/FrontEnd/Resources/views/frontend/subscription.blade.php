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
            /* background-color: #fafafa; */
        }
        .card{
            border-radius: 15px;
        }
        .top{
            background: #538cc4;
            padding: 30px;
        }
        .top_content {
            background: #1c449d;
            color: #fff;
            position: absolute;
            left: 0;
            translate: 5% -49%;
            width: 91%;
            padding: 20px;
            box-shadow: 0 28px 40px -40px #000;
            border-radius: 15px;
        }
        .top_content h2, .top_content h3{
            color: #fff;
        }
        #subscription_page ul{
            list-style-type: none;
            padding-left: 0;
        }
        #subscription_page ul li{
            margin-bottom: 15px;
            font-size: 20px;
        }

        .custom_button{
            border: none;
            border-top: 1px solid #1c449d;
            border-radius: 0 0 15px 15px;
            background: #1c449d;
            color: #fff;
        }
        .description{
            padding: 15px;
            border-radius: 10px;
            background: #161616;
        }
    </style>
@endpush

@section('content')

<section id="subscription_page" class="pb-5">
    <div class="container-fluid py-2">

        <div class="row">
            <div class="col-md-10 mb-4">
                <h5 class="m-0 text-light"><i class="fi fi-ss-money-check-edit" style="position: relative; top: 3px"></i> Plan d'abonnement</h5>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12">
                <div class="description">
                    <div class="row justify-content-center py-4">
                        @foreach ($subscriptions as $subscription)
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    {{-- <div class="card-header bg-white">

                                    </div> --}}
                                    <div class="card-body text-center p-0 mt-3">

                                        <div class="top mt-5">
                                            <div class="top_content">
                                                <h2 class="my-0 fw-bold text-center my-3">{{ $subscription->title }}</h2>
                                                <h3>
                                                    <span class="display-6">{{ $subscription->price }}</span>$
                                                    <small class="fw-light"> / {{ $subscription->duration }} {{ $subscription->duration_type }}</small></h3>
                                            </div>
                                        </div>

                                        <div class="mt-5 pt-5 text-start px-5 text-white">
                                            <ul>
                                                <li>
                                                    @if($subscription->option_ad_free == 'Active')
                                                    <i class="fi fi-ss-check text-success"></i>
                                                    @else
                                                    <i class="fi fi-ss-cross-small text-danger"></i>
                                                    @endif
                                                    {{ __('subscription::subscription.subscription.form.option_ad_free') }}
                                                </li>
                                                <li>
                                                    @if($subscription->option_live_content == 'Active')
                                                    <i class="fi fi-ss-check text-success"></i>
                                                    @else
                                                    <i class="fi fi-ss-cross-small text-danger"></i>
                                                    @endif
                                                    {{ __('subscription::subscription.subscription.form.option_live_content') }}
                                                </li>
                                                <li>
                                                    @if($subscription->option_premium_content == 'Active')
                                                    <i class="fi fi-ss-check text-success"></i>
                                                    @else
                                                    <i class="fi fi-ss-cross-small text-danger"></i>
                                                    @endif
                                                    {{ __('subscription::subscription.subscription.form.option_premium_content') }}
                                                </li>
                                                <li>
                                                    <i class="fi fi-ss-check text-success"></i>
                                                    {{ $subscription->trial_days }}
                                                    {{ __('subscription::subscription.subscription.form.trial_days') }}
                                                </li>
                                            </ul>
                                        </div>

                                        @if(auth()->check())
                                            <a href="{{ route('frontend.checkout') }}?subscription_id={{ $subscription->id }}" type="button" class="w-100 btn btn-lg btn-outline-primary py-4 mt-4 custom_button">S'abonner</a>
                                        @else
                                            <a href="{{ route('admin.login') }}?redirect=subscription" type="button" class="w-100 btn btn-lg btn-outline-primary py-4 mt-4 custom_button">Connectez-vous pour vous abonner</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('js')

@endpush
