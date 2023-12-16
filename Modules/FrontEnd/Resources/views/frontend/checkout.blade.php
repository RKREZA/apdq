@extends('frontend::frontend.layouts.master')

@section('title')
Check-out
@endsection
@section('seo')
    <meta name="title" content="Check-out">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="Check-out" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>
        #checkout_page{
            background-color: #fafafa;
        }
        .card{
            border-radius: 15px;
        }
        .header h4{
            border: none;
            background: #9fcaf9;
            color: #fff;
            padding: 17px;
        }
        .top{
            background: #538cc4;
            padding: 30px;
        }
        .top_content {
            background: #9fcaf9;
            color: #fff;
            position: absolute;
            left: 0;
            translate: 5% -49%;
            width: 91%;
            padding: 20px;
            box-shadow: 0 28px 40px -40px #000;
            border-radius: 15px;
        }
        #checkout_page ul{
            list-style-type: none;
            padding-left: 0;
        }
        #checkout_page ul li{
            margin-bottom: 15px;
            font-size: 20px;
        }


        .custom_button{
            border: none;
            border-top: 1px solid #528bc2;
            border-radius: 0 0 15px 15px;
            background: #528bc2;
            color: #fff;
        }
        .custom_button i{
            position: relative;
            top: 3px;
        }



        .imgbgchk:checked + label>.tick_container{
            opacity: 1;
        }
/*         aNIMATION */
        .imgbgchk:checked + label>img{
            opacity: 0.7;
            border: 3px solid #9fcaf9;
        }
        label{
            position: relative;
        }
        .tick_container {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            cursor: pointer;
            text-align: center;
        }
        .tick {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            padding: 10px 12px;
            height: 40px;
            width: 40px;
            border-radius: 100%;
        }


    </style>
@endpush

@section('content')

<section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/checkout.webp" alt="">
    <div class="content">
        <h1>Check-out</h1>
    </div>
</section>
<section id="checkout_page" class="py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body text-center p-0 mt-3">

                        <div class="top mt-5">
                            <div class="top_content">
                                <h2 class="my-0 fw-bold text-center my-3">{{ $subscription->title }}</h2>
                                <h3>
                                    <span class="display-6">{{ $subscription->price }}</span>$
                                    <small class="fw-light"> / {{ $subscription->duration }} {{ $subscription->duration_type }}</small></h3>
                            </div>
                        </div>

                        <div class="mt-5 pt-5 pb-4 text-start px-5">
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

                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body mt-3 p-0">

                        <div class="header mt-5">
                            <h4>Paiement avec</h4>
                        </div>

                        <div class="row m-4">
                            @foreach ($payment_gateways as $payment_gateway)

                                @if ($payment_gateway->code == 'paypal')
                                    <div class='col-md-4 text-center'>
                                        <input type="radio" name="payment_gateway" id="img1" class="d-none imgbgchk" checked value="{{ $payment_gateway->code }}">
                                        <label for="img1" class="p-3">
                                            <img src="{{ asset('assets/frontend/img/paypal.png') }}" alt="Image 1" class="img-thumbnail p-4">
                                            <div class="tick_container">
                                                <div class="tick"><i class="fi fi-ss-check"></i></div>
                                            </div>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div class="footer">
                            


                            <form action="{{ route('frontend.paypal') }}" method="post">
                                @csrf
                                <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">
                                <button type="submit" class="w-100 btn btn-lg btn-outline-primary py-4 mt-4 custom_button">
                                    <i class="fi fi-ss-money-bill-wave"></i>
                                    Payer
                                    ({{ $subscription->price }}$)
                                </a>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('js')

@endpush
