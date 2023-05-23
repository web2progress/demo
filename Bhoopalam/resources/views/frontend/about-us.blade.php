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
<!-- body  -->
<div class="container-fluid py-4">
    <div class="container">
      <div class="row py-2 justify-content-center">
        <div class="header">
          <h2>About Us</h2>
        </div>
      </div>
      <div class="row py-3">
        <div class="main_about">
          <
          <div class="second">
          <P>
            <img src="frontend/images/about1.webp" alt=""> <br>
            Our uber cool network design team keeps the hustle going- all the way from Europe! They know all the ropes when it comes to giving you the best internet experience thanks to their knowledge of the Internet ecosystem!  </P>



          <p  class="marginleft">
            <img src="frontend/images/about2.webp" alt=""> <br>
            We are in it to win it! With the top ISP’s on our side, our operations team loves to aim high and has overseen the evolution of Broadband in India like never before. With LIT knowledge and resources at hand, our team has all it takes to roll out seamless networks all throughout the country.</p>
          </div>
          <h4>Our Vision:</h4>
          <p>Our business strategy is focused on the development of building of various kinds (to the extent to which
            this is possible) of manufacture and project management of light and heavy engineering, precision machining
            for all types of material. The main vision is to have the highest customer satisfaction of any foundry in
            the India and while having a commitment to quality through the strength of our greatest asset: our people.
            Our care for employee satisfaction and working conditions are also our constant concern.
          </p>
          <h4>Our Mission:</h4>
          <p>As our region continues to prosper and grow in rich resources such as fabrication and machining so to do
            the products and services we provide. We have the capabilities, facilities, and equipment to do small and
            medium jobs in any one of the industries we work within.</p>
          <span class="msn_state"><i>Our mission statement: </i></span><span class="comma">&#8220;</span> <span>It is
            the mission of PVR Industries to be the finest commercial quality Precision machined component supplier in
            India. We understand that we cannot be successful unless our customers are successful. We are committed to
            enhancing our customer’s success with responsiveness, quality and service that sets the industry standard.
            PVR Industries understands the value of continual improvement and commitment to our most valuable asset, our
            people. We will strive to be the best in every aspect of our business by utilizing our core competencies,
            fostering a culture of trust, teamwork, and responsibility.</span><span class="comma">&#8221;</span></span>
          <br>
          <br>
          <h4>Our Quality Policies:</h4>
          <p>To reach our objectives we plan, implement and control systems which facilitate the management of quality
            on our projects by implementing the following principals:</p>
          <ul>
            <li>Maintain excellent communications with clients.</li>
            <li>Continually improve our services through review of our goals and objectives.</li>
            <li>Continually improve the skills and competencies of our workforce.</li>
            <li>Generating the Quality Inspection Report once Quality testing and Inspection done.</li>
          </ul>
          These principals are incorporated in blood streams of our business planning process to provide the framework
          for the delivery of a quality service to our clients.
          </p>
        </div>
      </div>
    </div>
  </div>
  <!------------Our Goals--------------->
  <div class="container-fluid py-4">
    <div class="px-4">
      <div class="row py-2 justify-content-center">
        <div class="uniHeading text-center">
          <h2>Business goals & objectives:</h2>
          <p>In the achievement of our strategy the following tasks have been defined,<br> that at the same time take
            into consideration the present and define the future of our company:</p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="goal_box text-center">
            <div class="goal_img">
              <img src="/frontend/images/quality_imp.png" width="100%" alt="img">
            </div>
            <div class="goal_text text-center">
              <h5>Improving quality</h5>
              <p>Improving quality is a key manufacturing objective. Companies must produce quality products that meet
                or exceed customers’ expectations and minimize waste. Quality products can help to improve customer
                satisfaction, increase sales and improve customer retention.</p>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="goal_box text-center">
            <div class="goal_img">
              <img src="/frontend/images/cost_reduction.png" width="100%" alt="img">
            </div>
            <div class="goal_text">
              <h5>Cost-reduction</h5>
              <p>Companies set cost-reduction objectives to ensure they can offer competitive prices and make a profit.
                Manufacturing teams can cut costs by reducing inventory, sourcing from lower-cost suppliers, increasing
                productivity, automating processes and implementing quality .</p>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="goal_box text-center">
            <div class="goal_img">
              <img src="/frontend/images/flexibility.png" width="100%" alt="img">
              <div class="goal_text">
                <h5>Increase flexibility</h5>
                <p>By setting increased flexibility as a manufacturing objective, companies can meet a wider range of
                  market requirements and improve competitive advantage. Establishing flexible production facilities
                  enables companies to offer customized products tailored to customers’ needs.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="goal_box text-center">
            <div class="goal_img">
              <img src="/frontend/images/time_manage.png" width="100%" alt="img">
            </div>
            <div class="goal_text">
              <h5>Great Time Management:</h5>
              <p>The path to a productive workday is time management. With manufacturers, there are so many different
                tasks taking place throughout the day, which means being efficient with time is all the more important.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- end body  -->
@endsection
@section('footer')
@parent
<!--================ End Footer Area =================-->
@endsection
