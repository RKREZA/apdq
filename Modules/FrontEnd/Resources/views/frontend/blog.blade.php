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
        #blog_page .image-container{
            background-size: cover;
            height: 250px;
            background-position: center;
        }


        #blog_page .card{
            border-radius: 5px;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            background: #2c2c2c82;
        }
        #blog_page #blog_content .card:hover{
            transform: scale(1.05);
        }
        #blog_page img{
            width: 100%;
        }

        #blog_page .post-content h6{
            max-height: 40px;
            overflow: hidden;
        }

        #blog_page .post-content .sub-content{
            max-height: 30px;
            overflow: hidden;
        }


        #blog_page .sub-content small,#blog_page .sub-content small a{
            font-size: 11px;
            color: #9e9e9e;
        }

        #blog_page .sub-content small a:hover{
            color: #0D99DC !important;
        }
    </style>
@endpush

@section('content')

<div id="blog_page" class="pb-5">
    <div class="container-fluid py-2">

        <div class="row">
            <div class="col-md-10 mb-4">
                <h5 class="m-0 text-light"><i class="fi fi-ss-blog-text" style="position: relative; top: 3px"></i> Blog</h5>
            </div>
        </div>


        @if (isset(request()->tag))
            <div class="mb-3">
                <span class="badge bg-dark text-light badge-sm">
                    <i class="fi fi-ss-label" style="transform: rotate(90deg); display:inline-block;"></i> &nbsp;
                    {{ request()->tag }}
                </span>
            </div>
        @endif

        <div class="row">
            <div class="col-md-3" id="filter">
                <div class="card">
                    {{-- <div class="card-header bg-white">
                        <h5 class="mt-2">Filter</h5>
                    </div> --}}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="text-white">Catégorie</h6>
                                <hr class="horizontal light">
                                <ul>
                                    @foreach($post_categories as $category)
                                    <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="category" id="category_input{{ $category->code }}" value="{{ $category->code }}" @if(request()->code == $category->code) checked @endif>
                                            <label class="form-check-label text-white" for="category_input{{ $category->code }}">
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

            <div class="col-md-9" id="blog_content">
                @if(auth()->user() && auth()->user()->subscriptionStatus()['status'] != 'no_subscription' && auth()->user()->subscriptionStatus()['optionAdFree'] == 'Active' && auth()->user()->hasRole('User'))

                @else

                    <div class="row justify-content-center mb-3" id="ad_banner_2">
                        <div class="col" style="min-width: 260px;">
                            <!-- Mods Center Responsive -->
                            {{-- <ins class="adsbygoogle"
                                style="display:block"
                                data-ad-client="ca-pub-7301992079721298"
                                data-ad-slot="4688267585"
                                data-ad-format="auto"
                                data-full-width-responsive="true"></ins> --}}

                                <img src="{{ asset('assets/frontend/img/ad-placeholder.png') }}" alt="" style="width: 100%; border-radius: 15px;">
                        </div>
                    </div>
                @endif

                <div class="row">

                    @foreach ($posts as $post)

                        <div class="col-md-4 mb-4">
                            <div class="card border-0">
                                <div class="card-body p-0">

                                    <a href="{{ route('frontend.blog.single', $post->slug) }}" class="">
                                        @if (!empty($post->files[0]['path']))
                                            <div class="image-container" style="background-image:url({{ $post->files[0]['path'] }});"></div>
                                        @else
                                            <div class="image-container" style="background-image:url(assets/frontend/img/no-image.webp);"></div>
                                        @endif


                                    </a>

                                    <div class="post-content p-3">
                                        <h6><a href="{{ route('frontend.blog.single', $post->slug) }}" class="text-white">{{ $post->title }}</a></h6>
                                        <div class="row sub-content">
                                            <div class="col-6">
                                                <small><a href="" class="text-white"><i class="fi fi-ss-clipboard-list-check"></i> {{ $post->category->name }}</a></small>
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

                <div class="row mt-4">
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
