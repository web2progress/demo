@extends('layouts.app')
@section('title', 'Home')
@section('header')
    <!-- meta data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <!-- HTML Meta Tags -->
    <meta name="title" content="Title">
    <meta name="keywords" content="Keyword here">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="author" content="Munna Patel">
    <meta name="description" content="description">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="title">
    <meta property="og:image" content="{{ url('/') }}/image.jpg">
    <meta property="og:site_name" content="domain">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="title">
    <meta property="twitter:description" content="description">
    <meta property="twitter:image" content="{{ url('/') }}/image.jpg">
    @parent
    <!--------Owl Carausel----------->
    <link rel="stylesheet" href="{{ asset('frontend/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/owlcarousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/mixSlide.css') }}" />
@endsection
@section('content')
    <!--------------slider banner---------------------->
    <section class="banner__slider text-shadow ">
        <div class="slider stick-dots">
            @foreach ($slider as $slide)
                <div class="slide">
                    <div class="slide__img">
                        <img src="{{ asset('images/slider/') }}/{{ $slide->image }}" alt="slider_img"
                            class="full-image animated" data-animation-in="zoomInImage" />
                    </div>
                    @if ($slide->style_type == '1')
                        <div class="slide__content slide__content__left">
                            <div class="slide__content--headings text-left">
                                <!-- <img src="/frontend/images/3.png"class="animated top-title img-fluid w-75" data-animation-in="fadeInRight" data-delay-in="0.2"> -->
                                @if (!empty($slide->heading_txt))
                                    <h2 class="animated title mb-4" data-animation-in="fadeInRight">
                                        {!! $slide->heading_txt !!} </h2>
                                @endif
                                @if (!empty($slide->paragraf_txt))
                                    <p class="tagline" data-animation-in="fadeInLeft" data-delay-in="0.2">
                                        {!! $slide->paragraf_txt !!}</p>
                                @endif
                                @if (!empty($slide->btn_txt))
                                    <a href="{{ $slide->slug }}" class="btn-primary btn button-custom animated"
                                        data-animation-in="fadeInUp">{{ $slide->btn_txt }}</a>
                                @endif
                            </div>
                        </div>
                    @elseif($slide->style_type == '2')
                        <div class="slide__content slide__content__right">
                            <div class="slide__content--headings text-left">
                                @if (!empty($slide->paragraf_txt))
                                    <p class="animated top-title" data-animation-in="fadeInLeft" data-delay-in="0.2">
                                        {!! $slide->paragraf_txt !!}</p>
                                @endif
                                @if (!empty($slide->heading_txt))
                                    <h2 class="animated title mb-4" data-animation-in="fadeInLeft">
                                        {!! $slide->heading_txt !!}</h2>
                                @endif
                                @if (!empty($slide->btn_txt))
                                    <a href="{{ $slide->slug }}" class="btn-success btn button-custom animated text-white"
                                        data-animation-in="fadeInUp">{{ $slide->btn_txt }}</a>
                                @endif
                            </div>
                        </div>
                    @elseif($slide->style_type == '2')
                        <div class="slide__content ">
                            <div class="slide__content--headings text-center ">
                                @if (!empty($slide->paragraf_txt))
                                    <p class="animated top-title" data-animation-in="fadeInUp" data-delay-in="0.3">
                                        {!! $slide->paragraf_txt !!}</p>
                                @endif
                                @if (!empty($slide->heading_txt))
                                    <h2 class="animated title mb-4" data-animation-in="fadeInUp">
                                        {!! $slide->heading_txt !!}</h2>
                                @endif
                                @if (!empty($slide->btn_txt))
                                    <a href="{{ $slide->slug }}" class="btn-success btn button-custom animated text-white"
                                        data-animation-in="fadeInUp">{{ $slide->btn_txt }}</a>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="slide__content slide__content__left">
                            <div class="slide__content--headings text-left">
                                <!-- <img src="/frontend/images/3.png"class="animated top-title img-fluid w-75" data-animation-in="fadeInRight" data-delay-in="0.2"> -->
                                @if (!empty($slide->heading_txt))
                                    <h2 class="animated title mb-4" data-animation-in="fadeInRight">
                                        {!! $slide->heading_txt !!} </h2>
                                @endif
                                @if (!empty($slide->paragraf_txt))
                                    <p class="tagline" data-animation-in="fadeInLeft" data-delay-in="0.2">
                                        {!! $slide->paragraf_txt !!}</p>
                                @endif
                                @if (!empty($slide->btn_txt))
                                    <a href="{{ $slide->slug }}" class="btn-primary btn button-custom animated"
                                        data-animation-in="fadeInUp">{{ $slide->btn_txt }}</a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
                fill="none" stroke="currentColor">
                <circle r="20" cy="22" cx="22" id="test">
            </symbol>
        </svg>
    </section>
    <!--------------slider banner end---------------------->
    <div class="container home-up">
        <div class="row">
            <div class="col-sm-8">
                <div class="home-baner1">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="home-baner2">
                    <form method="post" action="{{url('/enquiry')}}" class="form-inhome">
                        @csrf
                        <h3 style="text-align: center;color:white;;font-weight: bold;">Enquiry Form</h3>
                        <div class="input-group">
                            <input class="form-control" type="text" name="name" placeholder=" Name">
                        </div>
                        <div class="input-group">
                            <input class="form-control" type="text" name="number" placeholder="Mobile Number"><br>
                        </div>
                        <div class="input-group">
                            <input class="form-control" type="text" name="email" placeholder="Email">
                        </div>
                        <div class="input-group">
                            <input class="form-control" type="text" name="message" placeholder="Message "><br>
                        </div>
                        <button class="btn btn-warning" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- --------------------------SPECIAL OFFER-------------------------------------- -->
    <section class="container-fluid home-slider12">
        <div class="container">
            <h3 style="text-align: center;"><span style="background: #045d5d;color: white;padding: 0px 41px;">SPECIAL
                    OFFER</span></h3>
            <div class="row">
                <div class="col-sm-6">
                    <div class="home-slider14">
                        <h1>300 Mbps</h1>
                        <h2 class="home-sliderpp">Fiber Broadband</h2>
                    </div>
                </div>
                <div class="col-sm-1">
                    <img class="images-it" src="/images/at.webp" alt="hfgf">
                    <img class="movile-it" src="/images/mobile-at.webp" alt="hfgf">
                </div>
                <div class="col-sm-5">
                    <div class="home-slider16">
                        <h1>424*</h1>
                        <h2 class="home-sliderpp">per month</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -------SPECIAL OFFER---end------------------------------>
    <!-- /--------------packages slider--offer--home----------------------------------------------------------- -->
    <section>
        <h2 style="text-align: center;text-align: center;padding: 16px 0px;font-weight: 800;color: #017e7e;">EXPERIENCE
            FLASH SPEED BROADBAND</h2>
        <div class="container">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="border-style14"></div>

                </div>
                <div class="col-sm-4"></div>
            </div><br>
            <!-- -------------------------------------------------------- -->
            <?php
            $plans=  DB::table('plans')
                      ->get();

                      $count=  DB::table('plans')
                      ->count();
            ?>
<!-- body  -->
<div class="container">
@if($count>0)

<div class="row">

@foreach ( $plans as  $plan )


<div class="col-sm-4  mt-4">
<div class="packages-offer">
    <img src="frontend/images/logos/product/download.jpg" alt="offer" style="width: 100%;">
    <div class="packages-heading15">
        <h2 class="packages-heading">Start</h2>
        <h2 class="packages-heading14">{{$plan->speed}}</h2>
        <h6 class="span-offer">Mbps</h6>
        <p class="MONTH-SECTION">MONTHS</p>
    </div>
    <div class="packages-heading19">
        <h3 class="packg">{{$plan->amount}}</h3>
        <h3 class="packages-heig">3</h3>
    </div>
    <div class="packages-heading19">
        <h3 class="packg">{{$plan->amount3}}</h3>
        <h3 class="packages-heig">6</h3>
    </div>
    <div class="packages-heading19">
        <h3 class="packg">{{$plan->amount6}}</h3>
        <h3 class="packages-heig">9</h3>
    </div>
    <div class="packages-heading19">
        <h3 class="packg">{{$plan->amount12}}</h3>
        <h4 class="packages-heig12">12</h4>
    </div>
    <a class="btn btn-success ml-2" href="{{url('plansview/'.$plan->id)}}" role="button">View More</a>

</div>
</div>

@endforeach

@else
<div>
<h1> No plan  </h1>
</div>
@endif
</div>
            <!-- -------------------OTT BONANZA------------------------------------- -->
            <div class="ott-bonanza my-5">
                <h2>OTT BONANZA</h2>
                <p>OTT Add-on PLAN Application </p>
                <h4>300 mbps & 400 mbps</h4>
            </div>
            <div class="border-style15"></div>
            <div class="col-md-10 offset-md-1 my-5">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="short-offer">
                            <div class="short-offer1">
                                <div class="row">
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="short-offer11b">
                                            <span
                                                style="font-weight: bold;font-size: 20px;">Rs.200/</span><span>Month+GST</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                    </div>
                                </div>
                            </div>
                            <p><span class="value-offer">BESTSELLER</span></p>
                            <div class="offericon-img">
                                <img src="/images/download.png" alt="jio tv">
                                <img src="/images/zee tv.jpg" alt="jio tv"><img src="/images/hotstar .jpg"
                                    alt="jio tv">
                                <img src="/images/gana (1).png" alt="jio tv"><img src="/images/sony liv (1).png"
                                    alt="jio tv">
                                <img src="/images/zee tv.jpg" alt="jio tv">
                            </div>
                            <div class="offericon-img">
                                <img src="/images/download.png" alt="jio tv">
                                <img src="/images/tv player.png" alt="jio tv"><img src="/images/hotstar .jpg"
                                    alt="jio tv">
                                <img src="/images/mx player (2).png" alt="jio tv"><img
                                    src="/images/Netflix_2015_logo.svg.png" alt="jio tv">
                                <img src="/images/zee5 (2).png" alt="jio tv">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="short-offer">
                            <div class="short-offer1">
                                <div class="row">
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="short-offer11b">
                                            <span
                                                style="font-weight: bold;font-size: 20px;">Rs.200/</span><span>Month+GST</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                    </div>
                                </div>
                            </div>
                            <p><span class="value-offer">BESTSELLER</span></p>
                            <div class="offericon-img">
                                <img src="/images/download.png" alt="jio tv">
                                <img src="/images/zee tv.jpg" alt="jio tv"><img src="/images/hotstar .jpg"
                                    alt="jio tv">
                                <img src="/images/gana (1).png" alt="jio tv"><img src="/images/sony liv (1).png"
                                    alt="jio tv">
                                <img src="/images/zee tv.jpg" alt="jio tv">
                            </div>
                            <div class="offericon-img">
                                <img src="/images/download.png" alt="jio tv">
                                <img src="/images/tv player.png" alt="jio tv"><img src="/images/hotstar .jpg"
                                    alt="jio tv">
                                <img src="/images/mx player (2).png" alt="jio tv"><img
                                    src="/images/Netflix_2015_logo.svg.png" alt="jio tv">
                                <img src="/images/zee5 (2).png" alt="jio tv">
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="short-offer">
                            <div class="short-offer1">
                                <div class="row">
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="short-offer11b">
                                            <span
                                                style="font-weight: bold;font-size: 20px;">Rs.200/</span><span>Month+GST</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                    </div>
                                </div>
                            </div>
                            <p><span class="value-offer">BESTSELLER</span></p>
                            <div class="offericon-img">
                                <img src="/images/download.png" alt="jio tv">
                                <img src="/images/zee tv.jpg" alt="jio tv"><img src="/images/hotstar .jpg"
                                    alt="jio tv">
                                <img src="/images/gana (1).png" alt="jio tv"><img src="/images/sony liv (1).png"
                                    alt="jio tv">
                                <img src="/images/zee tv.jpg" alt="jio tv">
                            </div>
                            <div class="offericon-img">
                                <img src="/images/download.png" alt="jio tv">
                                <img src="/images/tv player.png" alt="jio tv"><img src="/images/hotstar .jpg"
                                    alt="jio tv">
                                <img src="/images/mx player (2).png" alt="jio tv"><img
                                    src="/images/Netflix_2015_logo.svg.png" alt="jio tv">
                                <img src="/images/zee5 (2).png" alt="jio tv">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="short-offer">
                            <div class="short-offer1">
                                <div class="row">
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="short-offer11b">
                                            <span
                                                style="font-weight: bold;font-size: 20px;">Rs.200/</span><span>Month+GST</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                    </div>
                                </div>
                            </div>
                            <p><span class="value-offer">BESTSELLER</span></p>
                            <div class="offericon-img">
                                <img src="/images/download.png" alt="jio tv">
                                <img src="/images/zee tv.jpg" alt="jio tv"><img src="/images/hotstar .jpg"
                                    alt="jio tv">
                                <img src="/images/gana (1).png" alt="jio tv"><img src="/images/sony liv (1).png"
                                    alt="jio tv">
                                <img src="/images/zee tv.jpg" alt="jio tv">
                            </div>
                            <div class="offericon-img">
                                <img src="/images/download.png" alt="jio tv">
                                <img src="/images/zee tv.jpg" alt="jio tv"><img src="/images/hotstar .jpg"
                                    alt="jio tv">
                                <img src="/images/gana (1).png" alt="jio tv"><img src="/images/sony liv (1).png"
                                    alt="jio tv">
                                <img src="/images/zee tv.jpg" alt="jio tv">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -------------------For High-Speed Seamless Connectvity------------------ -->
    <div class="container">
        <h4 style="text-align: center;font-size: 33px;font-weight: 700;padding-top: 23px;">For High-Speed Seamless
            Connectvity</h4>
        <h3 style="text-align: center;padding: 10px;"><span
                style="background-color: #045d5d;border-bottom-left-radius: 23px;border-bottom-right-radius: 23px;color: white;box-shadow: rgba(0, 0, 0, 0.2) 0px 20px 30px;"><a
                    class="get-excitel" href="#">Get  Connection</a></span></h3>
        <h3 style="text-align: center;font-weight: 800;font-size: 30px;padding-top: 44px;">8,50,000+ Happy Homes <img
                src="" alt=""> with
            Bhoopalam Broadband</h3>
        <h6 style="text-align: center;font-size: 11px;"><span>Read TnCs here:<a
                    href="#">https://www.bhooplam.com/excitel-tnc</a><br>
                Per Month cost exclusive taxes*</span></h6>
        <h1 style="text-align: center;font-weight: 900;padding: 31px;font-size: 50px;">Benefits of High-Speed Internet</h1>
        <div class="row">
            <div class="col-sm-3">
                <div class="border-righthightspeed">
                    <img class="rounded mx-auto d-block" src="/images/alarm (1).webp" alt="">
                    <h4 style="text-align: center;font-weight: 700;">4 Hour Service
                        Resolution Promise</h4>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="border-righthightspeed">
                    <img class="rounded mx-auto d-block" src="/images/heart.webp" alt="">
                    <h4 style="text-align: center;font-weight: 700;padding-bottom: 13px;">Customer Service
                        You Will Love</h4>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="border-righthightspeed">
                    <img class="rounded mx-auto d-block" src="/images/4k.webp" alt=""><br>
                    <h4 style="text-align: center;font-weight: 700;padding-bottom: 37px;">Add on OTT
                        +Live TV</h4>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="border-righthightspeed">
                    <img class="rounded mx-auto d-block" src="/images/home.webp" alt=""><br>
                    <h4 style="text-align: center;font-weight: 700;padding-bottom: 13px;">Fiber To
                        The Home</h4>
                </div>
            </div>
        </div>
        <h4 style="text-align: center;padding: 13px 0px;font-weight: bold;">To Experince Super-Fast Internet</h4>
        <h3 style="text-align: center;padding: 10px;"><span
                style="background-color: #045d5d;border-bottom-left-radius: 23px;border-bottom-right-radius: 23px;color: white;box-shadow: rgba(0, 0, 0, 0.2) 0px 20px 30px;"><a
                    class="get-excitel" href="#">Get Bhoopalam Connection</a></span></h3>
    </div>
    <!-- -------------------For High-Speed Seamless Connectvity--end---------------- -->
    <!-- /--------------packages slider--offer------------------- -->
    <!-- ------------TAKE US HOME------------------------------------------- -->
    <section class="TAKEUS-HOME my-5">
        <div class="container">
            <h2 style="text-align: center;padding: 18px;font-weight: 800;color: #017e7e;">TAKE US HOME</h2>
            <div class="row">
                <div class="col-sm-6">
                    <img class="takeushome-img" src="/images/We-are-obsessed.webp" alt="img">
                </div>
                <div class="col-sm-6">
                    <h4 class="latest-hedding">We are obsessed!</h4>
                    <p class="latest-ppp">We, as a trusted internet connection provider near you, are obsessed to serve you
                        the
                        best.
                        And we know you are as obsessed with the internet as we are. Enjoy the best ultra-high-speed
                        broadband
                        services with us, at a speed of up to 100 Mbps per second! Sounds awesome, right?</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="latest-hedding">We are obsessed!</h4>
                    <p class="latest-ppp">We, as a trusted internet connection provider near you, are obsessed to serve you
                        the
                        best.
                        And we know you are as obsessed with the internet as we are. Enjoy the best ultra-high-speed
                        broadband
                        services with us, at a speed of up to 100 Mbps per second! Sounds awesome, right?</p>
                </div>
                <div class="col-sm-6">
                    <img class="takeushome-img" src="/images/We-are-obsessed.webp" alt="img">
                </div>
            </div><br>
            <div class="row">
                <div class="col-sm-6">
                    <img class="takeushome-img" src="/images/We-are-obsessed.webp" alt="img">
                </div>
                <div class="col-sm-6">
                    <h4 class="latest-hedding">We are obsessed!</h4>
                    <p class="latest-ppp">We, as a trusted internet connection provider near you, are obsessed to serve you
                        the
                        best.
                        And we know you are as obsessed with the internet as we are. Enjoy the best ultra-high-speed
                        broadband
                        services with us, at a speed of up to 100 Mbps per second! Sounds awesome, right?</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ------------TAKE US HOME-----end-------------------------------------- -->
    <!-- ///// -----------------testimonial start------------------------ -->
    <section class="fist-section py-5">
        <h4 class="text-heading">The standard Lorem Ipsum passage, used since the 1500s</h4>
        <p class="pargrap-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
        <div class="container my-5">
            <div class="owl-carousel owl-theme">
                @if (!empty($latests))
                    @foreach ($latests as $key => $latest)
                        <div class="item-packages card">
                            @php
                                $thumbnail = $latest->thumbnail ? $latest->thumbnail : url('images/thumbnail.jpg');
                            @endphp
                            <div class="thumbnail-h" style="background-image: url('{{ $thumbnail }}'); background-size:cover;">
                                @if (!empty($latest->categories))
                                    @foreach (explode(',', $latest->categories) as $key => $postCat)
                                        {{-- get row by each category --}}
                                        @if ($key == 0)
                                            @php
                                                $catData = \App\Models\BlogCategory::where('id', $postCat)->first();
                                            @endphp
                                            {{-- prient category --}}
                                            <a class="category-blog-h"
                                                href="/category/{{ $catData->slug }}">{{ $catData->title }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <a href="{{ url('') }}/post/{{ $latest->slug }}">
                                <h2 class="text-name h5">{{ $latest->title }}</h2>
                            </a>
                            <p class="top-slider"> {{ $latest->description }}</p>
                            <div class="card-footer d-flex justify-content-between">
                                <div>
                                    <a href="{{ url('') }}/post/{{ $latest->slug }}" class="btn btn-slider"> Read
                                        More</a>
                                </div>
                                <div>
                                    <i class="fa-solid fa-eye">{{ $latest->view }}</i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- testimonial section -->
    <section class="testimonial py-4">
        <div class="container">
            <div class="row heading center_heading justify-content-center text-center" data-aos="zoom-in-up"
                data-aos-duration="600" data-aos-offset="40">
                <h1 class="text-white">Feedback</h1>
            </div>
            <div class="row justify-content-center ">
                <div class="testimonial_right">
                    <div class="owl-carousel owl-theme">
                        <div class="card item px-2 py-1" data-aos="zoom-in-up" data-aos-duration="600"
                            data-aos-offset="40">
                            <div class="row">
                                <div class="col-sm-4 px-0 d-flex align-items-center justify-content-center">
                                    <div class="client_img mx-auto">
                                        <img src="/frontend/images/user.png" width="100%" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-body ps-0 pe-1">
                                        <h6 class="client_name">
                                            R. Lakshmi Priya</h6>
                                        <p class="mb-1"><span class="quote me-1"><i class="fa fa-quote-left"
                                                    aria-hidden="true"></i></span>Marketing Cafe provides systematic method
                                            in marketing. Their team is knowledgeable,responsive and committed to supporting
                                            our products
                                            and initiates marketing them invaluable.....
                                            <span class="quote ms-1"><i class="fa fa-quote-right"
                                                    aria-hidden="true"></i></span>
                                        </p>
                                        <p class="designation mb-0">Sharp Hydro, Coimbatore</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card item px-2 py-1" data-aos="zoom-in-up" data-aos-duration="600"
                            data-aos-offset="40">
                            <div class="row">
                                <div class="col-sm-4 px-0 d-flex align-items-center justify-content-center">
                                    <div class="client_img mx-auto">
                                        <img src="/frontend/images/user.png" width="100%" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-body ps-0 pe-1">
                                        <h6 class="client_name">
                                            Sukhbaj Singh</h6>
                                        <p class="mb-1"><span class="quote me-1"><i class="fa fa-quote-left"
                                                    aria-hidden="true"></i></span>We have been tremendously benefitted from
                                            the vast industry experiences & network of Marketing Café who helped us add new
                                            product
                                            lines for our business........
                                            <span class="quote ms-1"><i class="fa fa-quote-right"
                                                    aria-hidden="true"></i></span>
                                        </p>
                                        <p class="designation mb-0">S B Electric, Amritsar</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card item px-2 py-1" data-aos="zoom-in-up" data-aos-duration="600"
                            data-aos-offset="40">
                            <div class="row">
                                <div class="col-sm-4 px-0 d-flex align-items-center justify-content-center">
                                    <div class="client_img mx-auto">
                                        <img src="/frontend/images/user.png" width="100%" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-body ps-0 pe-1">
                                        <h6 class="client_name">
                                            Praphul H</h6>
                                        <p class="mb-1"><span class="quote me-1"><i class="fa fa-quote-left"
                                                    aria-hidden="true"></i></span>We are thankful to Mr Satish Mishra of
                                            Marketing cafe, his detailed observation and modern strategy planning helped us
                                            to bring
                                            more leads to our designing business.
                                            <span class="quote ms-1"><i class="fa fa-quote-right"
                                                    aria-hidden="true"></i></span>
                                        </p>
                                        <p class="designation mb-0">Ashashree Business Solutions</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card item px-2 py-1" data-aos="zoom-in-up" data-aos-duration="600"
                            data-aos-offset="40">
                            <div class="row">
                                <div class="col-sm-4 px-0 d-flex align-items-center justify-content-center">
                                    <div class="client_img mx-auto">
                                        <img src="/frontend/images/user.png" width="100%" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-body ps-0 pe-1">
                                        <h6 class="client_name">
                                            Praphul H</h6>
                                        <p class="mb-1"><span class="quote me-1"><i class="fa fa-quote-left"
                                                    aria-hidden="true"></i></span>We are thankful to Mr Satish Mishra of
                                            Marketing cafe, his detailed observation and modern strategy planning helped us
                                            to bring
                                            more leads to our designing business.
                                            <span class="quote ms-1"><i class="fa fa-quote-right"
                                                    aria-hidden="true"></i></span>
                                        </p>
                                        <p class="designation mb-0">Ashashree Business Solutions</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card item px-2 py-1" data-aos="zoom-in-up" data-aos-duration="600"
                            data-aos-offset="40">
                            <div class="row">
                                <div class="col-sm-4 px-0 d-flex align-items-center justify-content-center">
                                    <div class="client_img mx-auto">
                                        <img src="/frontend/images/user.png" width="100%" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-body ps-0 pe-1">
                                        <h6 class="client_name">
                                            R. Lakshmi Priya</h6>
                                        <p class="mb-1"><span class="quote me-1"><i class="fa fa-quote-left"
                                                    aria-hidden="true"></i></span>Marketing Cafe provides systematic method
                                            in marketing. Their team is knowledgeable,responsive and committed to supporting
                                            our products
                                            and initiates marketing them invaluable.....
                                            <span class="quote ms-1"><i class="fa fa-quote-right"
                                                    aria-hidden="true"></i></span>
                                        </p>
                                        <p class="designation mb-0">Sharp Hydro, Coimbatore</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card item px-2 py-1" data-aos="zoom-in-up" data-aos-duration="600"
                            data-aos-offset="40">
                            <div class="row">
                                <div class="col-sm-4 px-0 d-flex align-items-center justify-content-center">
                                    <div class="client_img mx-auto">
                                        <img src="/frontend/images/user.png" width="100%" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-body ps-0 pe-1">
                                        <h6 class="client_name">
                                            R. Lakshmi Priya</h6>
                                        <p class="mb-1"><span class="quote me-1"><i class="fa fa-quote-left"
                                                    aria-hidden="true"></i></span>Marketing Cafe provides systematic method
                                            in marketing. Their team is knowledgeable,responsive and committed to supporting
                                            our products
                                            and initiates marketing them invaluable.....
                                            <span class="quote ms-1"><i class="fa fa-quote-right"
                                                    aria-hidden="true"></i></span>
                                        </p>
                                        <p class="designation mb-0">Sharp Hydro, Coimbatore</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card item px-2 py-1" data-aos="zoom-in-up" data-aos-duration="600"
                            data-aos-offset="40">
                            <div class="row">
                                <div class="col-sm-4 px-0 d-flex align-items-center justify-content-center">
                                    <div class="client_img mx-auto">
                                        <img src="/frontend/images/user.png" width="100%" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card-body ps-0 pe-1">
                                        <h6 class="client_name">Dr. Jhon</h6>
                                        <p><span class="quote me-1"><i class="fa fa-quote-left"
                                                    aria-hidden="true"></i></span>Lorem Ipsum is simply dummy text of the
                                            printing and typesetting industry. Lorem Ipsum has been the industry's standard
                                            dummy text
                                            ever since the 1500s, when an unknown printer
                                            <span class="quote ms-1"><i class="fa fa-quote-right"
                                                    aria-hidden="true"></i></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end body  -->
@endsection
@section('footer')
    @parent
    <!--================ End Footer Area =================-->
    <script src="{{ asset('frontend/js/jquery.vporel.mixSlide.js') }}"></script>
    <script src="{{ asset('frontend/owlcarousel/owl.carousel.min.js') }}"></script>
    <script>
        /*
         ** With Slick Slider Plugin : https://github.com/marvinhuebner/slick-animation
         ** And Slick Animation Plugin : https://github.com/marvinhuebner/slick-animation
         */
        // Init slick slider + animation
        $('.slider').slick({
            autoplay: true,
            speed: 700,
            lazyLoad: 'progressive',
            arrows: true,
            dots: false,
            prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
            nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
        }).slickAnimation();
        $('.slick-nav').on('click touch', function(e) {
            e.preventDefault();
            var arrow = $(this);
            if (!arrow.hasClass('animate')) {
                arrow.addClass('animate');
                setTimeout(() => {
                    arrow.removeClass('animate');
                }, 1600);
            }
        });
        /* accordian */
        var acc = document.getElementsByClassName("accordion");
        var i;
        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
        $(function() {
            $("#diaporama").mixSlide({
                fullscreen: true,
                thumbs: {
                    active: true,
                    position: "bottom",
                },
                controls: {
                    active: true,
                    position: "top",
                },
                transition: {
                    name: "random",
                    constant: false,
                },
                animation: {
                    delay: 3,
                    speed: 1,
                },
                autoplay: true,
                labels: {
                    active: true,
                    position: "bottom-right",
                },
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.testimonial .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                dots: false,
                nav: true,
                autoplay: true,
                center: true,
                addClassActive: true,
                autoplaytimeout: 500,
                responsiveClass: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 1,
                    },
                    1000: {
                        items: 3,
                        loop: true,
                        margin: 10
                    }
                }
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.services .owl-carousel').owlCarousel({
                loop: true,
                margin: 20,
                dots: false,
                nav: false,
                autoplay: true,
                center: true,
                addClassActive: true,
                autoplaytimeout: 500,
                responsiveClass: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 1,
                    },
                    1000: {
                        items: 3,
                        loop: true,
                        margin: 10
                    }
                }
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.our_clients .owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                dots: false,
                nav: true,
                autoplay: true,
                center: true,
                addClassActive: true,
                autoplaytimeout: 500,
                responsiveClass: true,
                navText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 1,
                    },
                    1000: {
                        items: 5,
                        loop: true,
                        margin: 10
                    }
                }
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 3
                    }
                }
            })
        })
    </script>
@endsection
