@extends('layouts.app')
@section('title', 'Privacy Policy')
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
<meta property="og:site_name" content="Shyam Sundar Pathak">
<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{url('/')}}">
<meta property="twitter:title" content="meta_title">
<meta property="twitter:description" content="meta_description">
<meta property="twitter:image" content="{{url('/')}}/image.jpg">
@parent
<!-- external  -->
<link rel="stylesheet" href="{{asset('assets/f-book/css/style.css')}}">
@endsection
@section('content')
<!-- body  -->
<div class="mt-manage">
    <div class="my-intro-us">
        <h2>Privacy Policy</h2>
    </div>
    <div class="container about-intro-text">
	 :-
<b>Introduction :-</b>
At domain.com (“us”, “we”, “our” or the “Company”) we value your privacy and the importance of safeguarding your data. This Privacy Policy ("Privacy Policy") describes our privacy practices for the activities set out below. As per your rights, we inform you how we collect, store, access, and otherwise process information relating to individuals. In this Policy, "Personal Data" refers to any information that on its own, or in combination with other available information, can distinguish an individual.<br>
We are committed to protecting your privacy in accordance with the highest level of privacy regulation. As such, we follow the obligations under the Indian law.<br>
<b>This policy applies to the SSP websites and domains.</b>
This Policy does not apply to third-party applications, websites, products, services or platforms that may be accessed through (non SSP ) links that we may provide to you. These sites are owned and operated independently from us, and they have their own separate privacy and data collection practices. Any personal data that you provide to these websites will be governed by the third-party’s own privacy policy. We cannot accept liability for the actions or policies of these independent sites, and we are not responsible for the content or privacy practices of such sites.<br>
<b>Processing Activities</b>
This Privacy Policy applies when you interact with us by doing any of the following:<br>
Make use of our application and services as an authorized user
Visit any of our websites that link to this Privacy Statement
Receive any communication from us including newsletters, emails, calls, or texts<br>
<b>Data You Provide</b>
When you make a purchase, or attempt to make a purchase, we collect personal data as part of your order information.<br>
<b>This data includes:</b>
Account information such as your name, email address, and password
Payment information such as your billing address, phone number, credit card, debit card or other payment method<br>
If you provide us, or our service providers, with any Personal Data relating to other individuals, you represent that you have the authority to do so and acknowledge that it will be used in accordance with this Privacy Statement. If you believe that your Personal Data has been provided to us improperly, or to otherwise exercise your rights relating to your Personal Data, please contact us by using the information set out in the Contact Us section below.
<b>Device and Usage Data</b><br>
When you visit a SSP website, we automatically collect and store information about your visit using browser cookies (files which are sent by us to your computer), or similar technology. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. The Help Feature on most browsers will provide information on how to accept cookies, disable cookies or to notify you when receiving a new cookie. If you do not accept cookies, you may not be able to use some features of our Service and we recommend that you leave them turned on.<br>
<b>Data we collect from third parties</b><br>
We may receive your personal data from third parties such as companies subscribing to SSP services, partners and other sources. This information is not collected by us but by a third party and is subject to the relevant third party’s own separate privacy and data collection policies. We do not have any control or input on how your personal data is handled by third parties. As always, you have the right to review and rectify this information. If you have any questions you should first contact the relevant third party for further information about your personal data. Where that third party is unresponsive to your rights, you may contact the Data Protection Officer at SSP (contact details below) and we can assist you.<br>
Our websites and services may contain links to other websites, applications and services maintained by third parties. The information practices of such other services, or of social media networks that host our branded social media pages, are governed by third parties’ privacy statements, which you should review to better understand those third parties’ privacy practices.<br>
<b>Changes :-</b>
We may modify this Policy at any time. If we make changes to this Policy then we will post an updated version of this Policy on this website. When using our services, you will be asked to review and accept our Privacy Policy. In this manner, we may record your acceptance and notify you of any future changes to this Policy.<br>
If you have consented to our processing of your personal data, you have the right to withdraw your consent at any time, free of charge, such as where you wish to unsubscribe from marketing messages that you receive from us. If you wish to withdraw your consent, please contact us using the information found at the bottom of this page.<br>
To request a copy for your information, unsubscribe from our email list, request for your data to be deleted, or ask a question about your data privacy, we've made the process simple:<br>
<b>Shyam Sundar Pathak<br>
Email :- contact@domain.com, <br>
Noida, India<br>
You can also give us a call back @ +91-+91 9760800271</b>
    </div>
    <div class="about-btm-pen">
        <img src="{{asset('assets/images/pen.png')}}" class="img-fluid" alt="">
        <div id="typedtext">
            <h2>– श्याम सुंदर पाठक। <span>'अनंत'</span></h2>
        </div>
    </div>
</div>
<!-- end body  -->
@endsection
@section('footer')
@parent
<!--================ End Footer Area =================-->
<script src="{{asset('assets/f-book/js/jquery.min.js')}}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/jquery-hammerjs@2.0.0/jquery.hammer.min.js'></script>
<script <script src="{{asset('assets/f-book/js/script.js')}}"></script>
<script>
    if (window.matchMedia("(min-width: 768px)").matches) {
        $('.scene').click(function() {
            $('.scene').css({
                left: '22%',
                width: '42%',
            });
        });
    }
    if (window.matchMedia("(max-width: 768px)").matches) {
        $('.scene').click(function() {
            $('.scene').css({
                left: '33%',
                width: '65%',
            });
        });
    }
</script>
@endsection
