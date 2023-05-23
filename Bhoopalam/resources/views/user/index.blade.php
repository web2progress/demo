@extends('layouts.app')
@section('title', 'Dashborad')
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
    <meta property="og:url" content="{{ url('/') }}/">
    <meta property="og:title" content="meta_title">
    <meta property="og:image" content="{{ url('/') }}/image.jpg">
    <meta property="og:site_name" content="Shyam Sundar Pathak">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="meta_title">
    <meta property="twitter:description" content="meta_description">
    <meta property="twitter:image" content="{{ url('/') }}/image.jpg">
    @parent
    <!-- external  -->
    <link rel="stylesheet" href="{{ asset('frontend/css/user-dash.css') }}">

@endsection
@section('content')


<div class="container-fluid bg-light">
    <div class="row p-0 border-bottom dashboard_header">
        @include('user.__sidebar-dashboard')
        <div class="col-sm-9">
            <div class="text-dark">

            </div>
        </div>
    </div>
</div>



@endsection
@section('footer')
    @parent

@endsection
