@extends('frontend::frontend.layouts.master')

@section('title')
Blog
@endsection
@section('seo')
    <meta name="title" content="Blog">
    <meta name="description" content="{{ $frontend_setting->meta_description }}">
    <meta name="keywords" content="{{ $frontend_setting->meta_keywords }}">

    <meta property="og:title" content="Blog" />
    <meta property="og:description" content="{{ $frontend_setting->social_description }}" />
    <meta property="og:image" content="{{ $frontend_setting->logo_dark }}" />
@endsection

@push('css')
    <style>
#blog_page{
    /* background-image: linear-gradient(90deg, #03e2cd 0%, #6254fc 90%); */
    background-color: #fafafa;
}
#blog_page .image-container{
    background-size: cover;
    height: 170px;
    background-position: center;
    border-radius: 10px;
}

#blog_page .container{
    z-index: 2;
    position: relative;
}

#blog_page img{
    width: 100%;
}

#blog_page .card{
    min-height: 210px;
    border-radius: 20px;
    border: 0;
    transition: all .5s;
    z-index: 2;
    box-shadow: 0px 7px 27px -27px #000;
}

#blog_page .card:hover{
    box-shadow: none;
}

#blog_page .post-content h6{
    max-height: 40px;
    overflow: hidden;
}

#blog_page .sub-content small, #blog_page .sub-content small a{
    font-size: 11px;
    color: #9e9e9e;
}

#blog_page #filter .card{
    border: 1px solid #ccc;
    box-shadow: none;
}

#blog_page #filter .card .card-header{
    border-radius: 20px 20px 0 0;
}
    </style>
@endpush

@section('content')

<section id="page_header" class="video_page_header">
    <img src="/assets/frontend/img/blog.webp" alt="">
    <div class="content">
        <h1>Blog</h1>
    </div>
</section>

<div id="blog_page" class="py-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4" id="filter">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mt-2">Filter</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h6>Category</h6>
                                <ul>
                                    @foreach($post_categories as $category)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="category" id="category_input{{ $category->code }}" value="{{ $category->code }}" @if(request()->code == $category->code) checked @endif>
                                            <label class="form-check-label" for="category_input{{ $category->code }}">
                                                {{ $category->name }}
                                            </label>
                                          </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row">

                    @foreach ($posts as $post)

                        <div class="col-md-4 mb-4">
                            <div class="card border-0">
                                <div class="card-body p-0">

                                    <a href="{{ route('frontend.blog.single', $post->slug) }}" class="">
                                        @if (!empty($post->files[0]['path']))
                                            <div class="image-container" style="background-image:url({{ $post->files[0]['path'] }});">

                                            </div>
                                        @else
                                            <div class="image-container" style="background-image:url(assets/frontend/img/no-image.png);">

                                            </div>
                                        @endif


                                    </a>

                                    <div class="post-content p-3">
                                        <h6><a href="{{ route('frontend.blog.single', $post->slug) }}" class="link-dark">{{ $post->title }}</a></h6>
                                        <div class="row sub-content">
                                            <div class="col-6">
                                                <small><a href="" class=""><i class="fi fi-ss-clipboard-list-check"></i> {{ $post->category->name }}</a></small>
                                            </div>
                                            <div class="col-6 text-end">
                                                <small><i class="fi fi-ss-calendar-clock"></i> {{ date('d/m/Y', strtotime($post->created_at)) }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{ $posts->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('js')
<script>
    $(document).ready(function() {
        $('input[type=radio][name=category]').on('change', function() {
            var selectedCategoryCode = $('input[type=radio][name=category]:checked').val();
            window.location.href = `{{ route('frontend.blog') }}?code=` + selectedCategoryCode;
        });
    });
  </script>
@endpush
