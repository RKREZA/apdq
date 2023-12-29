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
            /* background-color: #fafafa; */
        }
        .card{
            border-radius: 15px;
        }
        .header h4{
            border: none;
            background: #1c449d;
            color: #fff;
            padding: 17px;
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
            border-top: 1px solid #1c449d;
            border-radius: 0 0 15px 15px;
            background: #1c449d;
            color: #fff;
        }

        .custom_button:disabled {
            visibility: hidden;
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
        .description{
            padding: 15px;
            border-radius: 10px;
            background: #161616;
        }


    </style>
@endpush

@section('content')

{{-- <section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/checkout.webp" alt="">
    <div class="content">
        <h1>Check-out</h1>
    </div>
</section> --}}
<section id="checkout_page" class="pb-5">
    <div class="container-fluid py-2">

        <div class="row">
            <div class="col-md-12">
                <h4>Check-out</h4>
            </div>
        </div>

        <div class="description">
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

                            <div class="mt-5 pt-5 pb-4 text-start px-5 text-white">
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
                                        <input type="radio" name="payment_gateway" id="paypal" class="d-none imgbgchk" value="{{ $payment_gateway->code }}">
                                        <label for="paypal" class="p-3">
                                            <img src="{{ asset('assets/frontend/img/paypal.png') }}" alt="Image 1" class="img-thumbnail p-4">
                                            <div class="tick_container">
                                                <div class="tick"><i class="fi fi-ss-check"></i></div>
                                            </div>
                                        </label>
                                    </div>
                                @endif

                                @if ($payment_gateway->code == 'stripe')
                                    <div class='col-md-4 text-center'>
                                        <input type="radio" name="payment_gateway" id="stripe" class="d-none imgbgchk" value="{{ $payment_gateway->code }}">
                                        <label for="stripe" class="p-3">
                                            <img src="{{ asset('assets/frontend/img/card.png') }}" alt="Image 1" class="img-thumbnail p-4">
                                            <div class="tick_container">
                                                <div class="tick"><i class="fi fi-ss-check"></i></div>
                                            </div>
                                        </label>
                                    </div>
                                @endif
                                @endforeach
                            </div>

                            <div class="footer">
                                <form action="" method="post" id="checkout_form">
                                    @csrf
                                    <input type="hidden" name="subscription_id" value="{{ $subscription->id }}">

                                    <div class="form-check mb-3 mx-4">
                                        <input class="form-check-input" type="checkbox" name="i_agree" id="i_agree" required>
                                        <label class="form-check-label ms-2 text-white" for="i_agree">{{ __('admin::auth.form.i_agree') }} <a href="#" target="_blank">{{ $page->title }}</a></label>
                                    </div>

                                    <button type="submit" class="w-100 btn btn-lg btn-outline-primary py-4 mt-4 custom_button" id="checkout_button" disabled>
                                        <i class="fi fi-ss-money-bill-wave"></i>
                                        Go to Payment Page
                                        {{-- ({{ $subscription->price }}$) --}}
                                    </a>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


@push('js')

<script>
    $(document).ready(function() {
        $('input[name="payment_gateway"]').change(function() {
            var selectedGateway = $('input[name="payment_gateway"]:checked').val();
            if (selectedGateway == 'paypal') {
                $('#checkout_form').attr('action', "{{ route('frontend.paypal') }}");
            } else if (selectedGateway == 'stripe') {
                $('#checkout_form').attr('action', "{{ route('frontend.stripe') }}");
            }
            
            $('#checkout_button').removeAttr('disabled');
            // Add more conditions for other payment gateways if needed
        });
    });
</script>

@endpush
