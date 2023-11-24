@php
$frontend_setting = \Modules\FrontEndManager\Entities\FrontendSetting::first();
@endphp
@extends('frontend::frontend.layouts.master')

@section('title')
{{ $cms->title }}
@endsection
@section('seo')
    <meta name="title" content="{{ $cms->title }}">
    <meta name="description" content="{{ $cms->title }}">
    <meta name="keywords" content="{{ $cms->title }}">

    <meta property="og:title" content="{{ $cms->title }}" />
    <meta property="og:description" content="{{ $cms->title }}" />
    <meta property="og:image" content="{{ $cms->title }}" />
@endsection

@push('css')
    <style>
        .content-text ul, .content-text ol, .content-text li {
            list-style-type: initial;
            list-style-position: inside;
            margin-left: 15px;
        }
    </style>
@endpush


@section('content')

    <section class="breadcrumb-area">
        <div class="container">
            <div class="bg-white p-3">
                <div class="breadcrumb_navigation">
                    <ul>
                        <li><a href="/">{{ __('frontendmanager::home.gallery.home') }}</a></li>
                        <li class="active">{{ $cms->title }}</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="content-text text_white">
                            <h5 class="h5">{{ $cms->title }}</h5>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="social-btn-sp float-end">
                            {!! $shareButtons !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section class="content-area ">
        <div class="container smalls">
            <div class="bg-white p-3">
                <div class="content-text cms_description">
                    @if (count($cms->files)>0)
                        <div class="row mb-3">
                            @foreach ($cms->files->sortByDesc('id') as $file)
                                @if (str_contains($file->name, '.jpg') || str_contains($file->name, '.jpeg') || str_contains($file->name, '.png') || str_contains($file->name, '.gif'))
                                    <div class="col-md-3 col-sm-6">
                                        <a href="/{{ $file->path }}" class="gallery-item zoom gallery-fix">
                                            <img src="/{{ $file->path }}" alt="img">
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    {!! $cms->description !!}

                    @if (count($cms->files)>0)
                        <div class="row mt-3">

                            @foreach ($cms->files as $file)
                                @if (str_contains($file->name, '.pdf'))
                                    <div class="col-md-12 mb-3">
                                        <div class="pdf-container-{{ $file->id }}" style="height: auto">

                                        </div>
                                    </div>
                                @endif

                                @push('js')
                                    <script src="https://unpkg.com/pdfobject@2.2.8/pdfobject.min.js"></script>
                                    <script>
                                        PDFObject.embed("/{{ $file->path }}", ".pdf-container-{{ $file->id }}", {height: "100vh"});
                                    </script>
                                @endpush

                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>



@endsection



