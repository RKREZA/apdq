@extends('frontend::frontend.layouts.master')

@section('title')
Contact
@endsection
@section('seo')
    <meta name="title" content="Contact">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="Contact" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>

    </style>
@endpush

@section('content')

<section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/about.webp" alt="">
    <div class="content">
        <h1>Contact</h1>
    </div>
</section>
<section id="contact_page" class="py-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Get in touch!</h2>
                <h6 class="text-muted">Share your thought</h6>
            </div>
        </div>

        <hr class="horizontal dark">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row align-items-center p-4" id="contact-form-container">
                    <div class="col-md-6 p-4 text-center">
                        <img src="{{ asset('assets/frontend/img/contact_icon.png') }}" class="m-4 left_image" alt="">
                    </div>
                    <div class="col-md-6 p-4">
                        <form action="{{ route('frontend.contact_go') }}" method="POST" id="contact_form">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="email" class="form-control border-radius-round" id="name" name="name" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control border-radius-round" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Mobile</label>
                                        <input type="number" class="form-control border-radius-round" id="mobile" name="mobile" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control border-radius-round" id="message" name="message" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-lg btn-primary border-radius-round w-100">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <hr class="horizontal dark">

    </div>
</section>

@endsection


@push('js')

<script>
    $(document).ready(function () {
        $('#contact_form').submit(function (e) {
            e.preventDefault();

            var form = $(this);

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                dataType: 'json',
                success: function (data) {
                    swal(data.success);
                },
                error: function (xhr, status, error) {
                    swal(xhr.responseJSON.error);
                }
            });
        });
    });
</script>

@endpush
