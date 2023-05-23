<!DOCTYPE html>
<html lang="en">

@extends('layouts.app')
@section('title', 'Home')
@section('header-link')
    @parent
    <title>Hotelmitra : Thank You</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
@endsection
@section('content')
    <div class="container-fluid bg pt-5">
        <div class="d-flex justify-content-center">
            <div class="col-sm-6 card card-c">
                <img class="img-logo-wth p-2" style="width: 320px" src="{{ asset('assets/images/logo/images.jpg') }}" alt="Hotelmitra Logo">
                <h2 class="mt-3 mb-3 text-danger">Hi {{ $name }}</h2>

                <p>Thanks for your inquiry. We are eager to assist you. Our advertising expert will be get in touch with you
                    shortly.<br>
                    Kindly update your requirements to our expert once they call and we promise we will share the best
                    possible quote for you.</p>

                <p>Warm Regards,</p>

                <h5>{{url('')}}</h3>
            </div>
        </div>
    </div>
@endsection


@section('footer')
    @parent
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                window.location = '/';
            }, 10000)
        })
    </script>
@endsection
