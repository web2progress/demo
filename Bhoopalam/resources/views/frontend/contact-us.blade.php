@extends('layouts.app')
@section('title', 'Contact Us')
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
<!-------Main Slider ------------>
<div class="container-fluid">
    <div class="row">
      <div class="banner">
        <div class="banner_text  header">
          <h2>Contact Us</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid py-md-4">
    <div class="container">
      <div class="row py-2 justify-content-center">
        <div class="uniHeading">
        </div>
      </div>
      <div class="row justify-content-center text-center py-md-4">
        <div class="col-sm-3 border-right con_box" data-aos="zoom-in-up" data-aos-duration="600" data-aos-offset="40">
          <div class="con_icon mb-3">
            <i class="fa-solid fa-phone-slash"></i>
          </div>
          <h3>Phone No</h3>
          <ul>
            <li>+91-9561017343 </li>
            <li>+91 9730936907</li>
          </ul>
        </div>
        <div class="col-sm-3 border-right con_box" data-aos="zoom-in-up" data-aos-duration="600" data-aos-offset="40">
          <div class="con_icon mb-3">
            <i class="fa-solid fa-envelope"></i>
          </div>
          <h3>Email Us</h3>
          <ul>
            <li>fabricationspvr@gmail.com</li>
          </ul>
        </div>
        <div class="col-sm-3 border-right con_box" data-aos="zoom-in-up" data-aos-duration="600" data-aos-offset="40">
          <div class="con_icon mb-3">
            <i class="fa-solid fa-lock-hashtag"></i>
          </div>
          <h3>GSTIN</h3>
          <p>27AXSPG1578L1ZS</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid py-md-4 bg-light ">
    <div class="container">
      <div class="row py-md-4">
        <div class="col-sm-6 pr-lg-0">
          <div class="form_img" data-aos="zoom-in-up" data-aos-duration="600" data-aos-offset="40">
            <img src="/frontend/images/Contact.jpg" width="100%">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="contact_form px-4 mb-3 " data-aos="zoom-in-up" data-aos-duration="600" data-aos-offset="40">
            <h3 class="text-center">Contact Form</h3>
            <form method="post" action="{{url('/enquiry')}}" class="form-inhome">
                @csrf
              <div class="row p-2">
                <div class="col-md-6">
                    <input name="name" class="fa-control form-control mb-4" placeholder="Enter Your Name*" type="text" required="">
                    <div class="invalid-feedback">
                        Enter Your Name*
                    </div>
                </div>
                <div class="col-md-6">
                    <input class="fa-control form-control " type="text" id="number" pattern="^[0-9]{5,15}$" name="number" placeholder="Enter Your Phone Number*" required="">
                    <div class="invalid-feedback">
                        Enter Your Phone Number*
                    </div>
                </div>
                <div class="col-md-12">
                    <input class="fa-control form-control  mb-4" name="email" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder=" Enter Your E-mail">
                    <div class="invalid-feedback">
                        Enter Your E-mail
                    </div>
                </div>
                <input type="hidden" name="subject" value="Enquiry from :contact us">
                <div class="col-md-12">
                  <textarea class="form-control mb-3" rows="4" name="message" placeholder="Your Messages.."></textarea>
                </div>
              </div>
              <div class="row con_btn p-2 justify-content-center">
                <button type="submit" class="mx-3">Send Message</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid py-md-4 bg-white">
    <div class="container">
      <div class="row p-md-4">
        <div class="col-md-4">
          <div class="map_adress p-md-4 text-white m-2" data-aos="zoom-in-up" data-aos-duration="500" data-aos-offset="40">
            <li><i class="fa-solid fa-location-dot mr-2"></i>Adress</li>
            <p><span>Postal &Business  :</span> Sr. No. 154, Behind Hotel Pyramid, Near Magazine-Chauk, Bhosari-Alandi Road, Bhosari, Pune-411 039.
              <br>
             <span> New Address: </span>Shop No. 01, Opp. Smith International, Quality Circle Chauk, Telco-Road, Bhosari – 411 026.
              </p>
          </div>
        </div>
        <div class="col-md-8">
          <div class="map_location m-2" data-aos="zoom-in-up" data-aos-duration="600" data-aos-offset="40">
            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3780.631380554563!2d73.82680599999999!3d18.6356426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2b9fa70f4d00f%3A0xac619ce967e3127d!2sPVR%20INDUSTRIES%20-%20Machining%20and%20Fabrication%20Engineering%20Works!5e0!3m2!1sen!2sin!4v1670503325965!5m2!1sen!2sin" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
          </div>
        </div>
      </div>
    </div>
   </div>
<!-- body  -->
<!-- end body  -->
@endsection
@section('footer')
@parent
<!--================ End Footer Area =================-->
@endsection
