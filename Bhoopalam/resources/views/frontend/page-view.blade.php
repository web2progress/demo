@extends('layouts.app')
@section('title', $pages->title)
@section('header')
    @parent
    <!-- meta data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="pingback" href="/" />
    <meta name="description" content="{{ $pages->description }}" />
    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
    <link rel="canonical" href="{{ url('') }}/page/{{ $pages->url }}" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $pages->title }}" />
    <meta property="og:description" content="{{ $pages->description }}" />
    <meta property="og:url" content="{{ url('') }}/page/{{ $pages->url }}" />
    <meta property="og:site_name" content="MOBIPHARMA" />
    <meta property="article:publisher" content="https://www.facebook.com/" />
    <meta property="article:author" content="https://www.facebook.com/" />
    <meta property="article:section" content="Make Money Online" />
    <meta property="og:updated_time" content="2020-10-21T13:33:21+05:30" />
    <meta property="og:image"
        content="{{ $pages->thumbnail ? url('images/' . $pages->thumbnail) : url('images/thumbnail.jpg') }}" />
    <meta property="og:image:secure_url"
        content="{{ $pages->thumbnail ? url('images/' . $pages->thumbnail) : url('images/thumbnail.jpg') }}" />
    <meta property="og:image:width" content="696" />
    <meta property="og:image:height" content="385" />
    <meta property="og:image:alt" content="{{ $pages->title }}" />
    <meta property="og:image:type" content="image/png" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $pages->title }}" />
    <meta name="twitter:description" content="{{ $pages->description }}" />
    <meta name="twitter:site" content="@mobipharma" />
    <meta name="twitter:creator" content="@prabhanjan92" />
    <meta name="twitter:image"
        content="{{ $pages->thumbnail ? url('images/' . $pages->thumbnail) : url('images/thumbnail.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/switch/css/bootstrap-switch-button.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laraberg/css/laraberg.css') }}">
    <style>
        /*--------------------------------------------------------------
    # Alignments
    --------------------------------------------------------------*/
        .alignleft {
            display: inline !important;
            float: left;
            margin-right: 1.5em;
        }
        .alignright {
            display: inline !important;
            float: right;
            margin-left: 1.5em;
        }
        .aligncenter {
            clear: both;
            display: block !important;
            margin-left: auto;
            margin-right: auto;
        }
        @foreach (config('app.colors') as $color).has-{{ $color['slug'] }}-color {
            color: {!! $color['color'] !!};
        }
        .has-{{ $color['slug'] }}-background-color {
            background-color: {!! $color['color'] !!};
        }
        @endforeach
    </style>
    <!-- css -->
@endsection
@section('content')
    <div class="clear-fixed"></div>
    @if (!empty($pages->content))
        {!! $pages->content !!}
    @endif
    <div class="clear-fixed"></div>
    <!-- body  -->
@endsection
{{-- FOOTER --}}
@section('footer')
    @parent
    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
@endsection
