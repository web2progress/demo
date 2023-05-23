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
    @php
        $user = App\Models\User::where('id', auth()->user()->id)->first();
    @endphp
    <div class="container-fluid bg-light">
            <div class="row p-0 border-bottom dashboard_header">
                @include('user.__sidebar-dashboard')
                <div class="col-sm-9">
                    <div class="text-dark">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors)
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                @endif

                                <form method="post" action="{{ route('password.update') }}" id="passwordForm"
                                    class="needs-validation" novalidate>
                                    @csrf
                                    @method('post')

                                    <label class="mt-3">Current Password</label>
                                    <div class="form-group pass_show">
                                        <input type="password" name="current_password" class="form-control"
                                            placeholder="Current Password" required>
                                    </div>
                                    <label class="mt-3">Confirm Password</label>
                                    <div class="form-group pass_show">
                                        <input type="password" class="input-lg form-control" name="new_password" id="password1" placeholder="New Password" autocomplete="off" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <span id="8char" class="fa-solid fa-xmark" style="color:#FF0004;"></span> 8
                                            Characters Long<br>
                                            <span id="ucase" class="fa-solid fa-xmark" style="color:#FF0004;"></span>
                                            One Uppercase Letter
                                        </div>
                                        <div class="col-sm-6">
                                            <span id="lcase" class="fa-solid fa-xmark" style="color:#FF0004;"></span>
                                            One Lowercase Letter<br>
                                            <span id="num" class="fa-solid fa-xmark" style="color:#FF0004;"></span>
                                            One Number
                                        </div>
                                    </div>
                                    <label class="mt-3"> Confirm Password </label>
                                    <div class="form-group pass_show">
                                        <input type="password" class="input-lg form-control" name="new_password_confirmation"
                                            id="password2" placeholder="Repeat Password" autocomplete="off" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <span id="pwmatch" class="fa-solid fa-xmark" style="color:#FF0004;"></span>
                                            Passwords Match
                                        </div>
                                    </div>

                                    <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg mt-3" data-loading-text="Changing Password..." value="Change Password">
                                </form>
                            </div>
                            <!--/col-sm-6-->
                        </div>
                        <!--/row-->
                    </div>
                </div>
            </div>
    </div>



@endsection
@section('footer')
    @parent

    <script>
        $("input[type=password]").keyup(function() {
            var ucase = new RegExp("[A-Z]+");
            var lcase = new RegExp("[a-z]+");
            var num = new RegExp("[0-9]+");

            if ($("#password1").val().length >= 8) {
                $("#8char").removeClass("fa-xmark");
                $("#8char").addClass("fa-check");
                $("#8char").css("color", "#00A41E");
            } else {
                $("#8char").removeClass("fa-check");
                $("#8char").addClass("fa-xmark");
                $("#8char").css("color", "#FF0004");
            }

            if (ucase.test($("#password1").val())) {
                $("#ucase").removeClass("fa-xmark");
                $("#ucase").addClass("fa-check");
                $("#ucase").css("color", "#00A41E");
            } else {
                $("#ucase").removeClass("fa-check");
                $("#ucase").addClass("fa-xmark");
                $("#ucase").css("color", "#FF0004");
            }

            if (lcase.test($("#password1").val())) {
                $("#lcase").removeClass("fa-xmark");
                $("#lcase").addClass("fa-check");
                $("#lcase").css("color", "#00A41E");
            } else {
                $("#lcase").removeClass("fa-check");
                $("#lcase").addClass("fa-xmark");
                $("#lcase").css("color", "#FF0004");
            }

            if (num.test($("#password1").val())) {
                $("#num").removeClass("fa-xmark");
                $("#num").addClass("fa-check");
                $("#num").css("color", "#00A41E");
            } else {
                $("#num").removeClass("fa-check");
                $("#num").addClass("fa-xmark");
                $("#num").css("color", "#FF0004");
            }

            if ($("#password1").val() == $("#password2").val()) {
                $("#pwmatch").removeClass("fa-xmark");
                $("#pwmatch").addClass("fa-check");
                $("#pwmatch").css("color", "#00A41E");
            } else {
                $("#pwmatch").removeClass("fa-check");
                $("#pwmatch").addClass("fa-xmark");
                $("#pwmatch").css("color", "#FF0004");
            }
        });


        $(document).ready(function() {
            $('.pass_show').append('<span class="ptxt">Show</span>');
        });


        $(document).on('click', '.pass_show .ptxt', function() {

            $(this).text($(this).text() == "Show" ? "Hide" : "Show");

            $(this).prev().attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });

        });
    </script>
@endsection
