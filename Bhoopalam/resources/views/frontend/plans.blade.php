
@extends('layouts.app')
@section('title', 'About Us')
@section('header')
<!-- meta data -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<!-- HTML Meta Tags -->
<meta name="title" content="title">
<meta name="keywords" content="Keyword here">
<meta name="robots" content="index, follow">
<meta name="language" content="English">
<meta name="author" content="Munna Patel">
<meta name="description" content="description">
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{url('/')}}/">
<meta property="og:title" content="title">
<meta property="og:image" content="{{url('/')}}/image.jpg">
<meta property="og:site_name" content="site name">
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{url('/')}}">
<meta property="twitter:title" content="title">
<meta property="twitter:description" content="description">
<meta property="twitter:image" content="{{url('/')}}/image.jpg">
@parent
<!--other link-->
@endsection
@section('content')

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
                <h2 class="packages-heading "  >Start</h2>
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
            <a class="btn btn-primary ml-2" href="{{url('plansview/'.$plan->id)}}" role="button">View More</a>

        </div>
</div>

@endforeach

@else
<div>
    <h1> No plan  </h1>
</div>
@endif
</div>
<!-- end body  -->
@endsection
@section('footer')
@parent
<!--================ End Footer Area =================-->
@endsection
