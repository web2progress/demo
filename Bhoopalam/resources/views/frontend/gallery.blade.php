@extends('layouts.app')
@section('title', 'Gallery')
@section('header')
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
<meta property="og:site_name" content="domain">
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{url('/')}}">
<meta property="twitter:title" content="meta_title">
<meta property="twitter:description" content="meta_description">
<meta property="twitter:image" content="{{url('/')}}/image.jpg">
<!--other link-->
<link rel="stylesheet" type="text/css" href="{{asset('frontend/blog/css/main.css')}}">
@parent
<!--Modal-->
@endsection
@section('content')
<!-- body  -->
    <div class="scene">
        <!-- camera -->
        <div class="roll-camera">
            <div class="move-camera">
                <div class="wallpaper"></div>
                <!-- shelf -->
                <div class="heading-gallery">
                <h2 class="text-light">ALBUM</h2>
                </div>
                <div class="row d-flex justify-content-center outer-galley">
                    @foreach ($albums as $album )
                    <div class="col-sm-3">
                        <a href="{{url('/gallery')}}/{{ $album->album_slug}}">
                            <div class="album-outer">
                              @if ($album->gallery)
                                <img class="img-fluid" src="{{asset('images/gallery/')}}/{{$album->gallery->imag_title}}" alt="{{ $album->album_title}}">
                                @else
                                <img class="img-fluid" src="{{asset('assets/images/gallery-thumb.jpg')}}" alt="{{ $album->album_title}}">
                                @endif
                                <div class="album-titile">{{ $album->album_title}}
                                <!-- Count Specific cat  -->
                                <span>{{ App\Models\Gallery::where('album_id', $album->id)->count() }}
                                </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <!-- /shelf -->
            </div>
        </div>
    </div>
<!-- end body  -->
@endsection
{{-- FOOTER --}}
@section('footer')
@parent
<script>
    $(function() {
        var centerShelfs,
            $body = $('body'),
            centerShelfs = function() {
                var topShelfPosition = $body.height() / 2;
            };
        window.setTimeout(function() {
            $body.addClass('view-middle-shelf');
        }, 500);
    });
</script>
@endsection
