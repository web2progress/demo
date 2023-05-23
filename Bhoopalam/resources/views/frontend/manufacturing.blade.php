@extends('layouts.app')
@section('title', 'Manufacturing')
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
<!-- body  -->
  <!-------Main Slider ------------>
  <div class="container-fluid">
    <div class="row">
      <div class="banner">
        <div class="banner_text" >
          <h2 >Manufacturing</h2>
        </div>
      </div>
    </div>
  </div>
  <!---------Product manufacturing Details------------->
  <div class="container-fluid py-4">
    <div class="container">
      <div class="row py-2">
        <div class="col-sm-4">
           <div class="pro_img">
            <img src="/frontend/images/precision-turned-shaft.webp" width="100%">
           </div>
        </div>
        <div class="col-sm-8">
          <div class="pro_detail pt-3">
            <h2>Turned Shafts</h2>
            <p>First, oversized steel rods are placed into a lathe chuck and tightened, and a cutting tool is placed in the tool holder on the lathe. The lathe is then started and the rod begins to spin. Once the steel rod reaches the desired speed, the cutting tool is fed into the rod which begins the process. The turning continues until the steel rod is brought down to the desired size.</p>
            <li>Transmission shafts are used to transmit power between the source and the machine absorbing power; e.g. counter shafts and line shafts.</li>
            <li>  Machine shafts are the integral part of the machine itself; e.g. crankshaft.</li>
            <li> Axle shaft.</li>
             <li>Spindle shaft</li>
          </div>
        </div>
      </div>
      <div class="row py-2">
          <table class="table table-striped w-100 text-center table-bordered">
            <tr>
            <th>SR.NO</th>
            <th>DESCRIPTION</th>
            <th>MAKE</th>
            <th>QUANTITY</th>
          </tr>
          <tr>
            <td>1.</td>
            <td>Turned Shafts</td>
            <td>Macpower</td>
            <td>1</td>
          </tr>
          </table>
      </div>
    </div>
  </div>
<!-- end body  -->
@endsection
@section('footer')
@parent
<!--================ End Footer Area =================-->
@endsection
