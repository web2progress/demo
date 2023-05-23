@extends('admin.layouts.layouts')
@section('title', 'Dashboard')
@section('header-link')
    @parent
    {{-- custom link --}}
    <!--plugins-->
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')


jgkjghjgh



@endsection
@section('footer-script')
    @parent




@endsection

