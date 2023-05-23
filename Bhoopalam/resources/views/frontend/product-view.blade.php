@extends('layouts.app')
@section('title', $products->product_title)
@section('header')
    <!-- meta data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <!-- HTML Meta Tags -->
    <meta name="title" content="{{ $products->product_title }}">
    <meta name="description" content="{{ $products->product_description }}">
    <meta name="keywords" content="{{ $products->product_keyword }}">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Munna Patel">
    <meta name="description" content="{{ $products->product_description }}">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('') }}/">
    <meta property="og:title" content="{{ $products->product_title }}">
    <meta property="og:image" content="{{ url('') }}/image.jpg">
    <meta property="og:site_name" content="Oxford Pathology Lab">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('') }}/{{ $products->product_slug }}">
    <meta property="twitter:title" content="Oxford Pathology Lab">
    <meta property="twitter:description" content="{{ $products->product_description }}">
    <meta property="twitter:image" content="{{ url('') }}/image.jpg">
    <!--Modal-->
    <link rel="preload" href="{{ asset('images/products') }}/{{ $products->product_img }}" as="image">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/blog/css/main.css') }}">
    @parent
@endsection
@section('content')
    <div class="container-fluid theme-bg py-5 bg-header" data-stellar-background-ratio="0.5">
        <div class="row py-5">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white animated zoomIn">{{ $products->product_title }}</h1>
            </div>
        </div>
    </div>
    <!-- body  -->
    <div class="container pt-4">
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="img-box">
                            <img id="imgZoom" data-NZoomscale="2"
                                src="{{ asset('images/products') }}/{{ $products->product_img }}" class="card-img-top"
                                alt="{{ $products->product_title }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex justify-content-left">
                            <h2 class="font-weight-bold h4">{{ $products->product_title }}</h2>
                        </div>
                        <div class="d-flex justify-content-left">
                            <h5 class="mr-2"> ₹ {{number_format($products->product_amount) }}</h5>
                            @if (!empty($products->product_offer))
                                <del class="mrp-del"> ₹
                                    {{ number_format(($products->product_amount * $products->product_offer) / 100 + $products->product_amount) }}</del>
                            @endif
                        </div>
                        <p class="text-left mb-3">Category :
                            @if (!empty($getCatName->product_cat_title))
                                {{ $getCatName->product_cat_title }}
                            @endif
                        </p>
                        <hr>
                        <div class="text-left mt-3 mb-3 mt-5">{!! $products->product_short_description !!}
                        </div>
                        <div class="d-flex justify-content-left mt-4">
                            <button type="button" data-title="{{ $products->product_title }}" data-toggle="modal"
                                data-target="#PayModal" class="btn btn-primary send-eq">BOOK NOW</button>
                        </div>
                        <!-- share button  -->
                        <div class="share-outer mt-5">
                            <div class="share_div"><i class="fas fa-share"></i><span></span>
                                <h4>Share</h4>
                            </div>
                            <div class="social_icons">
                                <a class="social-button"
                                    href="https://www.facebook.com/sharer/sharer.php?u={{ url('') }}/product/{{ $products->product_slug }}">
                                    <div class="facebook">
                                        <i class="fab fa-facebook"></i>
                                    </div>
                                </a>
                                <a class="social-button"
                                    href="https://www.linkedin.com/shareArticle?url={{ url('') }}/product/{{ $products->product_slug }}">
                                    <div class="linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                    </div>
                                </a>
                                <a class="social-button"
                                    href="https://twitter.com/intent/tweet?text={{ $products->product_title }}&amp;url={{ url('') }}/product/{{ $products->product_slug }}"
                                    class="btn-sm social-share-twitter social-button btn btn-primary">
                                    <div class="twitter">
                                        <i class="fab fa-twitter"></i>
                                    </div>
                                </a>
                                <a class="social-button"
                                    href="https://wa.me/?text= 👉 Please share this website with your friends - {{ url('') }}/product/{{ $products->product_slug }}">
                                    <div class="whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                {!! $products->product_full_description !!}
            </div>
            <div class="col-sm-4">
                <!--sidebar -->
                @include('frontend._sidebar-products')
            </div>
        </div>
    </div>
    <div class="container py-4">
        <div class="d-flex justify-content-center">
            <h2 class="heading-pp radius">Similar Products</h2>
        </div>
        <div class="row m-0">
            @if (!empty($similars))
                @foreach ($similars as $key => $product)
                    @if ($product->status == 'publish')
                        <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s"
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
                                                <h5 class="mr-2"> ₹ {{ $product->product_amount }}</h5>
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
            @endif
        </div>
    </div>
    <!-- end body  -->
@endsection
{{-- FOOTER --}}
@section('footer')
    @parent
    <!--================ End Footer Area =================-->
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
