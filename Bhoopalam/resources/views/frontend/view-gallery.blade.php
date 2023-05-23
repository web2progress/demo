@extends('layouts.app')
@section('title', 'Gallery View')
@section('header')
    @parent
    <!-- meta data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <!-- HTML Meta Tags -->
    <meta name="title" content="meta_title">
    <meta name="keywords" content="meta_Keyword">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Munna Patel">
    <meta name="description" content="meta_description">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{url('/')}}/">
    <meta property="og:title" content="meta_title">
    <meta property="og:image" content="{{url('/')}}/image.jpg">
    <meta property="og:site_name" content="Shyam Sundar Pathak">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{url('/')}}">
    <meta property="twitter:title" content="meta_title">
    <meta property="twitter:description" content="meta_description">
    <meta property="twitter:image" content="{{url('/')}}/image.jpg">
    <!--other link-->
    <link rel="stylesheet" href="{{asset('assets/galley-lib/css/jquery.fancybox.min.css')}}">
    <!-- Popper JS -->
    <script src="{{asset('assets/galley-lib/js/popper.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/galley-lib/css/magnific-popup.min.css')}}"/>
    <!--Modal-->
@endsection
@section('content')
    <!-- body  -->
    <main class="main">
        <div class="container">
            <h3 class="album-title">{{$albums->album_title}}</h3>
            <div class="row pb-3" data-new-gr-c-s-check-loaded="14.1052.0" data-gr-ext-installed="">
                @if(($galleries->count() > 0))
                    @foreach($galleries as $gallery)
                        <div class="col-sm-6 col-md-4 col-lg-4 px-2 my-2">
                            <div class="card">
                                <div class="card-image">
                                    <a href="{{asset('images/gallery/')}}/{{$gallery->imag_title}}"
                                       data-fancybox="gallery"
                                       data-caption="Caption Images 1">
                                        <img src="{{asset('images/gallery/')}}/{{$gallery->imag_title}}"
                                             alt="{{$albums->album_title}}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="d-flex justify-content-center">
                        <h3 class="card p-4">Gallery Empty</h3>
                    </div>
                @endif
            </div>
        </div>
    </main>
    <!-- end body  -->
@endsection
{{-- FOOTER --}}
@section('footer')
    @parent
    <!--================ End Footer Area =================-->
    <script src="{{asset('assets/galley-lib/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('assets/galley-lib/js/jquery.magnific-popup.min.js')}}"></script>
    <script>
        // Fancybox Configuration
        $('[data-fancybox="gallery"]').fancybox({
            buttons: [
                "slideShow",
                "thumbs",
                "zoom",
                "fullScreen",
                "share",
                "close"
            ],
            loop: false,
            protect: true
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.gallerys').magnificPopup({
                type: 'image',
                delegate: 'a',
                gallery:
                    {
                        enabled: true
                    }
            });
        });
    </script>
@endsection
