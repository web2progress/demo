@extends('layouts.app')
@section('title', 'Products')
@section('header')
    <!-- meta data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <!-- HTML Meta Tags -->
    <meta name="title" content="Home - Oxford Pathology Lab">
    <meta name="keywords" content="Keyword here">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Munna Patel">
    <meta name="description" content="Blood Test , Sugar Test, Noida Sector 51 Pathology">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Oxford Pathology Lab,">
    <meta itemprop="description" content="Blood Test , Sugar Test, Noida Sector 51 Pathology">
    <meta itemprop="image" content="{{ url('') }}/image.jpg">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('') }}/">
    <meta property="og:title" content="Home - Oxford Pathology Lab">
    <meta property="og:image" content="{{ url('') }}/image.jpg">
    <meta property="og:site_name" content="Oxford Pathology Lab">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('') }}">
    <meta property="twitter:title" content="Home - Oxford Pathology Lab">
    <meta property="twitter:description" content="Blood Test , Sugar Test, Noida Sector 51 Pathology">
    <meta property="twitter:image" content="{{ url('') }}/image.jpg">
    @parent
@endsection
@section('content')
    <!-- body  -->
    <div class="container-fluid theme-bg py-3 bg-dark">
        <div class="row py-5">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white animated zoomIn">Latest Product
                </h1>
            </div>
        </div>
    </div>
    <div class="mt-manage">
        <section class="pt-5">
            <div class="container">
                <div class="row">
                    @if (!empty($allProducts))
                        @foreach ($allProducts as $key => $product)
                            @if ($product->status == 'publish')
                            <div class="col-sm-3 pr-lg-0">
                                <div class="items p-2">
                                    <div class="product-outer-div">
                                        <div class="itemimg"
                                            style="background-image: url({{ asset('images/products/thumbnails') }}/{{ $product->product_img }})"
                                            title="{{ $product->product_title }}">
                                        </div>
                                    </div>
                                    <h4 class="text-center">{{ $product->product_title }}</h4>
                                    <div class="enq_btn_odd d-flex justify-content-center py-2">
                                        <a href="#" data-title="{{ $product->product_title }}"   data-toggle="modal" data-target="#PayModal" class="send-eq px-4">Get Inquiry</a>
                                    </div>
                                    <span class="more">
                                        {!! strip_tags( $product->product_short_description) !!}
                                    </span>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="d-flex justify-content-center mt-5">
                @if (!empty($allProducts))
                    {!! $allProducts->links() !!}
                @endif
            </div>
        </section>
    </div>
    <!-- end body  -->
@endsection
@section('footer')
    @parent
<script>
       $(document).ready(function() {
            // Configure/customize these variables.
            var showChar = 100; // How many characters are shown by default
            var ellipsestext = "...";
            var moretext = "Show more >";
            var lesstext = "Show less";
            $('.more').each(function() {
                var content = $(this).html();
                if (content.length > showChar) {
                    var c = content.substr(0, showChar);
                    var h = content.substr(showChar, content.length - showChar);
                    var html = c + '<span class="moreellipses">' + ellipsestext +
                        '&nbsp;</span><span class="morecontent"><span>' + h +
                        '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
                    $(this).html(html);
                }
            });
            $(".morelink").click(function() {
                if ($(this).hasClass("less")) {
                    $(this).removeClass("less");
                    $(this).html(moretext);
                } else {
                    $(this).addClass("less");
                    $(this).html(lesstext);
                }
                $(this).parent().prev().slideToggle();
                $(this).prev().slideToggle();
                return false;
            });
        });
</script>
@endsection
