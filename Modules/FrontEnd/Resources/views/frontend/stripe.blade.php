@extends('frontend::frontend.layouts.master')

@section('title')
Payment
@endsection
@section('seo')
    <meta name="title" content="Payment">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="Payment" />
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
            border-radius: 50px;
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

        #payment-form .form-control {
            border-radius: 50px;
            padding-left: 15px;
            padding-right: 15px;
            background: #3f3f3f;
            border: 0;
            color: #9e9e9e;
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
        <h1>Payment</h1>
    </div>
</section> --}}
<section id="checkout_page" class="pb-5">
    <div class="container py-2">

        <div class="row">
            <div class="col-md-12">
                <h4><a href="{{ route('frontend.checkout') }}?subscription_id={{ $subscription->id }}" class="back_button"><i class="fi fi-sr-angle-small-left"></i></a> Payment</h4>
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
                                <h4>Payment Details</h4>
                            </div>

                            <div class="row m-4">
                                


                                <div class="panel panel-default credit-card-box">
                                    
                                    <div class="panel-body">
                        
                                        @if (Session::has('success'))
                                            <div class="alert alert-success text-center">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                                <p>{{ Session::get('success') }}</p>
                                            </div>
                                        @endif
                        
                                        @if (Session::has('error'))
                                            <div class="alert alert-danger text-center">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                                <p>{{ Session::get('error') }}</p>
                                            </div>
                                        @endif
                        
                                        <form role="form" 
                                                action="{{ route('frontend.stripe.post') }}" 
                                                method="post" 
                                                class="require-validation"
                                                data-cc-on-file="false"
                                                data-stripe-publishable-key="{{ $stripe_key }}"
                                                id="payment-form">
                                            @csrf
                        
                                            <div class='row mb-3'>
                                                <div class='col-xs-12 form-group required'>
                                                    <label class='control-label text-light'>Name on Card</label> 
                                                    <input class='form-control' size='4' type='text'>
                                                </div>
                                            </div>
                        
                                            <div class='row mb-3'>
                                                <div class='col-xs-12 form-group card required'>
                                                    <label class='control-label text-light'>Card Number</label> 
                                                    <input autocomplete='off' class='form-control card-number' maxlength='20' size='20' type='text'>
                                                </div>
                                            </div>
                        
                                            <div class='row mb-4'>
                                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                    <label class='control-label text-light'>CVC</label> 
                                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' minlength='3' maxlength='4' size='4' type='text'>
                                                </div>
                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                    <label class='control-label text-light'>Expiration Month</label> 
                                                    <input class='form-control card-expiry-month' placeholder='MM' minlength='2' maxlength='2' size='2' type='text'>
                                                </div>
                                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                    <label class='control-label text-light'>Expiration Year</label> 
                                                    <input class='form-control card-expiry-year' placeholder='YYYY' minlength='4' maxlength='4' size='4' type='text'>
                                                </div>
                                            </div>

                                            
    
                                            <div class='row my-3'>
                                                <div class='col-md-12 form-group'>
                                                    <div class="error d-none">
                                                        <div class='alert-danger alert'>Please correct the errors and try again.</div>
                                                    </div>
                                                </div>
                                            </div>
                        
                                            <div class="row mb-3 ">
                                                <div class="col-xs-12">
                                                    <button class="btn btn-primary btn-lg btn-block w-100 custom_button" type="submit">Pay Now {{ $subscription->price }}$ (CAD)</button>
                                                </div>
                                            </div>
                                                
                                        </form>
                                    </div>
                                </div>      
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

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");

        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                                 'input[type=text]', 'input[type=file]',
                                 'textarea'].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;

            $errorMessage.addClass('d-none');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('d-none');
                    e.preventDefault();
                }
            });

            var cardNumber = $('.card-number').val();
            var cardCVC = $('.card-cvc').val();
            var cardExpiryMonth = $('.card-expiry-month').val();
            var cardExpiryYear = $('.card-expiry-year').val();

            // Validate card number, CVC, expiry month, and expiry year using regex
            if (!/^\d+$/.test(cardNumber)) {
                $('.card-number').parent().addClass('has-error');
                $errorMessage.removeClass('d-none').text('Invalid card number. Please enter only numbers.').addClass('alert-danger alert');
                e.preventDefault();
                return;
            }

            if (!/^\d+$/.test(cardCVC)) {
                $('.card-cvc').parent().addClass('has-error');
                $errorMessage.removeClass('d-none').text('Invalid CVC. Please enter only numbers.').addClass('alert-danger alert');
                e.preventDefault();
                return;
            }

            if (!/^\d+$/.test(cardExpiryMonth)) {
                $('.card-expiry-month').parent().addClass('has-error');
                $errorMessage.removeClass('d-none').text('Invalid expiration month. Please enter only numbers.').addClass('alert-danger alert');
                e.preventDefault();
                return;
            }

            if (!/^\d+$/.test(cardExpiryYear)) {
                $('.card-expiry-year').parent().addClass('has-error');
                $errorMessage.removeClass('d-none').text('Invalid expiration year. Please enter only numbers.').addClass('alert-danger alert');
                e.preventDefault();
                return;
            }

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: cardNumber,
                    cvc: cardCVC,
                    exp_month: cardExpiryMonth,
                    exp_year: cardExpiryYear
                }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('d-none')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.append("<input type='hidden' name='subscription_id' value='{{ $subscription->id }}'/>");
                $form.get(0).submit();
            }
        }
    });
</script>


@endpush
