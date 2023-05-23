@extends('layouts.app')
@section('title', 'Blogs')
@section('header')
    @parent
    <!-- meta data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <!-- HTML Meta Tags -->
    <meta name="title" content="Home - Hotel Mitra Blog">
    <meta name="keywords" content="Keyword here">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Munna Patel">
    <meta name="description" content="Hotel Mitra Blog">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Hotel Mitra Blog">
    <meta itemprop="description" content="Hotel Mitra Blog">
    <meta itemprop="image" content="https://Hotelmitra.com/image.jpg">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://Hotelmitra.com/">
    <meta property="og:title" content="Home - Hotel Mitra Blog">
    <meta property="og:image" content="https://Hotelmitra.com/image.jpg">
    <meta property="og:site_name" content="Hotel Mitra Blog">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://www.Hotelmitra.com">
    <meta property="twitter:title" content="Home - Hotel Mitra Blog">
    <meta property="twitter:description" content="Hotel Mitra Blog">
    <meta property="twitter:image" content="https://Hotelmitra.com/image.jpg">
    <!--other link-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/blog/css/main.css') }}">
@endsection
@section('content')
    <!-- body  -->
    <!-- body  -->
    <div class="container-fluid theme-bg py-4 bg-header">
        <div class="row py-5">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white animated zoomIn">Blogs</h1>
                <a href="" class="h5 text-white">Home</a>
                <i class="far fa-circle text-white px-2"></i>
                <a href="" class="h5 text-white">Blogs</a>
            </div>
        </div>
    </div>
    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-8">
                    <div class="row g-5">
                        @if (!empty($postPaginates))
                            @foreach ($postPaginates as $postPaginate)
                                <div class="col-md-6">
                                    <div class="card blog_pack mt-4">
                                        <a href="{{ url('') }}/post/{{ $postPaginate->slug }}">
                                            <div class="thumbnail-box">
                                                <img src="{{ $postPaginate->thumbnail ? $postPaginate->thumbnail : url('images/thumbnail.jpg') }}"
                                                    width="100%" alt="{{ $postPaginate->title }}">
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            <div class="row d-flex justify-content-end">
                                                <div class="blog_pack_icon">
                                                    {{-- category first --}}
                                                    @if (!empty($postPaginate->categories))
                                                        @foreach (explode(',', $postPaginate->categories) as $key => $postCat)
                                                            {{-- get row by each category --}}
                                                            @if ($key == 0)
                                                                @php
                                                                    $catData = \App\Models\BlogCategory::where('id', $postCat)->first();
                                                                @endphp
                                                                {{-- prient category --}}
                                                                <a class=""
                                                                    href="/category/{{ $catData->slug }}">{{ $catData->title }}</a>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="blog__text px-2 border-bottom pb-3">
                                                    <h4><a class="title"
                                                            href="{{ url('') }}/post/{{ $postPaginate->slug }}">{{ $postPaginate->title }}</a>
                                                    </h4>
                                                    <p class="desc">{{ $postPaginate->description }}</p>
                                                    <div class="d-flex justify-content-between">
                                                        <span>
                                                            <i class="fas fa-clock mr-2"></i>
                                                            {{ $postPaginate->created_at->format('d-M-Y') }}
                                                        </span>
                                                        <span> <i class="far fa-eye mr-2" ></i>
                                                            {{ $postPaginate->view }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="view_service p-2 mt-2">
                                                    <a href="{{ url('') }}/post/{{ $postPaginate->slug }}"> Read
                                                        Me.. </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!-- Blog list End -->
                <!-- Sidebar Start -->
                <div class="col-lg-4">
                    @include('frontend.blogs._sidebar')
                </div>
                <!-- Sidebar End -->
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
@section('footer')
    @parent
    <!--================ End Footer Area =================-->
    <!-- carousel  -->
@endsection
