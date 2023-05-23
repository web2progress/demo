@extends('layouts.app')
@section('title', $category->product_cat_title)
@section('header')
    <!-- meta data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <!-- HTML Meta Tags -->
    <meta name="title" content="">
    <meta name="description" content="">
    <meta name="keywords" content="Keyword here">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Munna Patel">
    <meta name="description" content="type_your_description_here">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="">
    <meta itemprop="description" content="">
    <meta itemprop="image" content="{{ url('') }}//image.jpg">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('') }}//">
    <meta property="og:title" content="">
    <meta property="og:image" content="{{ url('') }}//image.jpg">
    <meta property="og:site_name" content="Oxford Pathology Lab">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('') }}/">
    <meta property="twitter:title" content="Oxford Pathology Lab">
    <meta property="twitter:description" content="">
    <meta property="twitter:image" content="{{ url('') }}//image.jpg">
    <!--Modal-->
    <!--other link-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" media="all">
    @parent
@endsection
@section('content')
    <div class="container-fluid theme-bg py-5 bg-header" style="background-image: url('/images/image_10.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="row py-5">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white animated zoomIn">{{ $category->product_cat_title }}
                </h1>
            </div>
        </div>
    </div>
    <!-- body  -->
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="row ">
                    @if (count($products) > 0)
                        @foreach ($products as $key => $product)
                            @if ($product->status == 'publish')
                                <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s"
                                    style="visibility: visible; animation-delay: 0.6s; animation-name: slideInUp;">
                                    <div class="card test_pack border-0 mt-3">
                                        <div class="thumbnail-box">
                                            <img src="{{ asset('images/products/thumbnails') }}/{{ $product->product_img }}"
                                                width="100%" alt="{{ $product->product_title }}" class="testPack_img">
                                            @if (!empty($product->product_offer))
                                                <span class="offer-price">{{ $product->product_offer }}
                                                    % OFF</span>
                                            @endif
                                        </div>
                                        <div class="card-body pb-0">
                                            <div class="row justify-content-center">
                                                <div class="test_name text-center">
                                                    <h4><a
                                                            href="{{ url('') }}/product/{{ $product->product_slug }}">{{ $product->product_title }}</a>
                                                    </h4>
                                                    <div class="d-flex justify-content-center mb-4">
                                                        <h5 class="mr-2"> ₹ {{number_format($product->product_amount) }}</h5>
                                                        @if (!empty($product->product_offer))
                                                            <del class="mrp-del"> ₹
                                                                {{ number_format(($product->product_amount * $product->product_offer) / 100 + $product->product_amount) }}</del>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="test_more">
                                                    <a href="#" data-title="{{ $product->product_title }}"
                                                        data-amount="{{ $product->product_amount }}" data-toggle="modal"
                                                        data-target="#PayModal" class="send-eq px-4">Book Now</a>
                                                    <a href="{{ url('') }}/product/{{ $product->product_slug }}">VIEW
                                                        DETAILS</a>
                                                </div>
                                            </div>
                                            <div class="row" style=" background-color: #afffac96; margin-top: -15px;">
                                                <div class="features p-2 mt-3">
                                                    <p class="text-uppercase">{{ $product->product_description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <h3 class="w-100 text-center">Category Empty</h3>
                    @endif
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {!! $products->links() !!}
                </div>
            </div>
            <div class="col-sm-3">
                <!--sidebar -->
                @include('frontend._sidebar-products')
            </div>
        </div>
    </div>
    <!-- end body  -->
@endsection
{{-- FOOTER --}}
@section('footer')
    @parent
    <!--================ End Footer Area =================-->
@endsection
