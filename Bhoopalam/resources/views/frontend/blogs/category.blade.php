@extends('layouts.app')
@section('title', 'Category')
@section('header')
    <!-- meta data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="pingback" href="/" />
    <meta name="description" content="{{ $categoryWise->cat_description }}" />
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
    <link rel="canonical" href="{{ url('') }}/post/{{ $categoryWise->cat_slug }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $categoryWise->cat_title }}" />
    <meta property="og:description" content="{{ $categoryWise->cat_description }}" />
    <meta property="og:url" content="{{ url('') }}/post/{{ $categoryWise->cat_slug }}" />
    <meta property="og:site_title" content="MOBIPHARMA" />
    <meta property="article:publisher" content="https://www.facebook.com/mobipharma" />
    <meta property="article:author" content="https://www.facebook.com/MunnaPatel" />
    <meta property="article:tag" content="{{ $categoryWise->cat_keyword }}" />
    <meta property="article:section" content="Make Money Online" />
    <meta property="og:updated_time" content="2020-10-21T13:33:21+05:30" />
    <meta property="og:image"
        content="{{ $categoryWise->thumbnail ? url($categoryWise->thumbnail) : url('images/thumbnail.jpg') }}" />
    <meta property="og:image:secure_slug"
        content="{{ $categoryWise->thumbnail ? url($categoryWise->thumbnail) : url('images/thumbnail.jpg') }}" />
    <meta property="og:image:width" content="696" />
    <meta property="og:image:height" content="385" />
    <meta property="og:image:alt" content="{{ $categoryWise->cat_title }}" />
    <meta property="og:image:type" content="image/png" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $categoryWise->cat_title }}" />
    <meta name="twitter:description" content="{{ $categoryWise->cat_description }}" />
    <meta name="twitter:site" content="@mobipharma" />
    <meta name="twitter:creator" content="@prabhanjan92" />
    <meta name="twitter:image"
        content="{{ $categoryWise->thumbnail ? url($categoryWise->thumbnail) : url('images/thumbnail.jpg') }}" />
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <link href='https://fonts.gstatic.com' crossorigin rel='preconnect' />
    <!--other link-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/blog/css/main.css') }}">
    @parent
    <!-- css -->
@endsection
@section('content')
    <!-- body  -->
    <div class="container-fluid pt-5 bg-blog">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-8 col-sm-12 col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><span>Category</span></li>
                        <li class="breadcrumb-item"><a
                                href="/categories/{{ $categoryWise->cat_slug }}">{{ $categoryWise->cat_title }}</a></li>
                    </ol>
                </nav>
                <!-- Blog Detail -->
                @if (!empty($postCategories))
                    <!-- body  -->
                    <!--Add content-->
                    @foreach ($postCategories as $cat)
                        @if ($cat->status == 'publish')
                            <div class="mt-4 card w-100">
                                <a href="{{ url('') }}/post/{{ $cat->slug }}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="{{ $cat->thumbnail }}" class="rounded img-fluid"
                                                alt="{{ $cat->title }}">
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="text-left">
                                                <h5 class="mb-1">{{ $cat->title }}</h5>
                                                <p class="text-dark">
                                                    <i>{{ $cat->created_at->format('d M Y') }}
                                                    </i>
                                                </p>
                                                <div class="text-dark">{{ $cat->description }}</div>
                                                <!--comments-->
                                                <small title="4 Comments" class="float-end mr-2">
                                                    @if (!empty($cat->view))
                                                        <span class="fas fa-eye"></span>
                                                        {{ $cat->view }}
                                                    @endif
                                                </small>
                                                <h6 class="btn  btn-success font-weight-bold">Read More</h6>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                    <!-- pagination  -->
                    <div class="d-flex justify-centent-center mt-5">
                        @if (!empty($postCategories))
                            {!! $postCategories->links() !!}
                        @endif
                    </div>
            </div>
            @endif
            <!-- Main Body -->
            <!-- Sidebar -->
            <div class="col-xl-4 col-md-4 col-sm-12 mt-4">
                @include('frontend.blogs._sidebar')
            </div>
        </div>
    </div>
    <!-- body  -->
@endsection
{{-- FOOTER --}}
@section('footer')
    @parent
    <!--================ End Footer Area =================-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        var popupSize = {
            width: 780,
            height: 550
        };
        $(document).on('click', '.social-button', function(e) {
            var verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
                horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);
            var popup = window.open($(this).prop('href'), 'social',
                'width=' + popupSize.width + ',height=' + popupSize.height +
                ',left=' + verticalPos + ',top=' + horisontalPos +
                ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');
            if (popup) {
                popup.focus();
                e.preventDefault();
            }
        });
    </script>
@endsection
