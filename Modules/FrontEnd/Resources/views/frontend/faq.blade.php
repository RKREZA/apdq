@php
$frontend_setting = \Modules\FrontEndManager\Entities\FrontendSetting::first();
@endphp
@extends('frontend::frontend.layouts.master')

@section('title')
সচরাচর জিজ্ঞাস্য
@endsection
@section('seo')
    <meta name="title" content="PMwords">
    <meta name="description" content="PMwords">
    <meta name="keywords" content="PMwords">

    <meta property="og:title" content="PMwords" />
    <meta property="og:description" content="PMwords" />
    <meta property="og:image" content="PMwords" />
@endsection


@section('content')
    <section class="wrapper bg-soft-primary">
        <div class="container py-3">
            <div class="row">
                <div class="col-md-12">
                    <a href="/" class="go_back">
                        <i class="bi bi-activity"></i>
                        <img src="{{ asset('assets/backend/img/icons/chevron-left.ico') }}" class="back_button" alt="">
                    </a>
                    <h1 class="display-4 mb-0">সচরাচর জিজ্ঞাস্য</h1>
                </div>
            </div>
        </div>
    </section>



    <section class="pmword">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto py-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                @foreach ($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $faq->id }}" aria-expanded="false" aria-controls="collapse_{{ $faq->id }}">
                                        {{ $faq->bn_title }}
                                      </button>
                                    </h2>
                                    <div id="collapse_{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                      <div class="accordion-body">
                                        {!! $faq->bn_description !!}
                                      </div>
                                    </div>
                                  </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
