@extends('frontend::frontend.layouts.master')

@section('title')
En direct
@endsection
@section('seo')
    <meta name="title" content="En direct">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="En direct" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>
        iframe {
            width: 100%;
            min-height: 500px;
        }
        .description {
            padding: 15px;
            border-radius: 10px;
            background: #161616;
            min-height: 70vh;
            max-height: 70vh;
            overflow: hidden;
        }

        .no-image {
            max-width: 100%; /* Use max-width instead of width */
            height: auto;
            max-height: 64vh; /* Set a specific height */
            object-fit: contain;
        }
    </style>
@endpush

@section('content')

<section id="video" class="pb-5">
    <div class="container-fluid py-2">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <h4>En direct</h4>
            </div>

            <div class="col-md-12">
                <div class="description">
                    @if(auth()->user() && auth()->user()->subscriptionStatus()['status'] != 'no_subscription'  && auth()->user()->subscriptionStatus()['optionLiveContent'] == 'Active')
                        @if($live)
                            {!! $live->embed_html !!}
                        @else
                            <img class="no-image" src="{{ asset('assets/frontend/img/no-video.png') }}" alt="">
                        @endif
                    @elseif(auth()->user() && auth()->user()->subscriptionStatus()['status'] != 'no_subscription')
                        <div class="text-center">
                            <p class="mt-3 text-center">Please subscribe to watch live stream!</p>
                            <a href="{{ route('frontend.subscription') }}" class="btn btn-warning text-center" target="_blank">{{ __('core::core.form.buy_now') }}</a>
                        </div>
                    @else
                        <div class="text-center">
                            <p class="mt-3 text-center">You don't have permission to watch live. Please change you subscription package to watch live stream!</p>
                            <a href="{{ route('frontend.subscription') }}" class="btn btn-warning text-center" target="_blank">{{ __('core::core.form.change') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</section>

@endsection


@push('js')

@endpush
