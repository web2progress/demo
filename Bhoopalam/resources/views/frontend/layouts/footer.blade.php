@section('footer')
<script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>

    <div class="modal fade" id="searchModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-dismiss="modal" aria-label="Close">X
                    </button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3"
                            placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="PayModal" tabindex="-1" role="dialog" aria-labelledby="bsBookingModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header theme-bg">
                    <h5 class="modal-title text-center text-light" id="bsBookingModal"> ENQUIRY FORM</h5>
                    <button type="button" class="btn bg-white btn-close" data-dismiss="modal" aria-label="Close">X
                    </button>
                </div>
                <div class="modal-body cc">

                    <!-- form  -->
                    <form id="booking-s" action="javascript:void(0)" method="post" class="needs-validation" novalidate="">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="forms-inputs mt-1">
                                            <span>Name*</span>
                                            <input type="text" id="name" name="name" class="form-control"
                                                required="" placeholder="your name*">
                                            <div class="invalid-feedback">
                                                Enter Your Name
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="forms-inputs mt-1">
                                            <span>Number*</span>
                                            <input type="text" id="number" pattern="^[0-9]{5,15}$" name="number"
                                                class="form-control" required="" placeholder="your number*">
                                            <div class="invalid-feedback">
                                                Enter Your Mo. Number
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="forms-inputs mt-1">
                                            <span>E-mail</span>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="your e-mail">
                                        </div>
                                    </div>

                                    <input type="hidden" id="subject" class="form-control" name="subject" readonly>

                                    <div class="col-sm-12 mb-3">
                                        <div class="forms-inputs mt-1">
                                            <span>Message</span>
                                            <textarea rows="4" class="form-control p-2" id="b_message" name="message" placeholder="Type Your Message"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success py-3 pl-5 pr-5 eq_submit">SEND</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>



    <section class="footer-bg">
        <div class="container footer-top text-white py-4">

            <div class="row pt-2">
                <div class="col-sm-3">
                    <div class="footer-top-item">

                        <div class="footer_logo py-4">
                            @if (!empty($media->logo))
                                <a href="{{ url('') }}">
                                    <img class="img-fluid" src="{{ url('assets/images/logo/' . $media->logo) }}"
                                        alt="preview logo">
                                </a>
                            @else
                                {{ config('app.name') }}
                            @endif
                        </div>
                        @if (!empty($media->address))
                            <p style="color:white;"> <i class="fa fa-map-marker me-3" aria-hidden="true"></i>
                                {!! $media->address !!}</p>
                        @endif

                        <ul class="footer_list ps-0 pb-2">
                            @if (!empty($media->mobileNumber))
                                <li>
                                    <a href="tel:@if (!empty($media->mobileNumber)) {{ $media->mobileNumber }} @endif">
                                        <i class="fa fa-phone me-2" aria-hidden="true"></i> {{ $media->mobileNumber }}
                                    </a>
                                </li>
                            @endif

                            @if (!empty($media->emailID))
                                <li>
                                    <a href="#">  <i class="fa fa-envelope me-2" aria-hidden="true"></i>
                                        {{ $media->emailID }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row pt-4">
                        <div class="col-sm-4">
                            <div class="footer-top-menu text-start">
                                <ul class="footer-link">
                                    <h3 class="footer-taxt">Important Links</h3>
                                    <li>
                                        <a href="{{ url('/about-us') }}"><i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>
                                            AboutUs </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/mmmmmmmmmmm') }}"><i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>
                                            Outsourced Training </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/mmmmmmmmmmm') }}"><i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>
                                            Outsourced Sales </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/mmmmmmmmmmm') }}"><i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>
                                            Outsourced Marketing </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="footer-top-menu">
                               <ul class="footer-link">
                                    <h3 class="footer-taxt">Resources</h3>
                                    <li><a href="{{ url('/mmmmmmmmmmm') }}">
                                            <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                            Inside Sales</a></li>
                                    <li><a href="{{ url('/mmmmmmmmmmm') }}"><i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>
                                            Lead Generation</a></li>
                                    <li><a href="{{ url('/mmmmmmmmmmm') }}"><i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>
                                            Offshore Sales</a></li>
                                    <li><a href="{{ url('/mmmmmmmmmmm') }}"><i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>
                                            Digital Marketing</a></li>
                                    <li><a href="{{ url('/mmmmmmmmmmm') }}"><i class="fa fa-chevron-right"
                                                aria-hidden="true"></i>
                                            Internship & Training </a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="footer-top-menu">

                                <div class="footer-link">
                                    <h3 class="footer-taxt">Social Links</h3>
                                    <div class="media-list">
                                        <p>Follow Us</p>
                                        <div class="social text-center d-flex text-light">
                                            @if (!empty($media->twitter))
                                                <div class="media_icon" style="background-color: #1da1f2;">
                                                    <a href="{{ $media->twitter }}">
                                                        <i class="fa-brands fab fa-twitter"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            @if (!empty($media->whats_app))
                                                <div class="media_icon" style="background-color: #0b9018;">
                                                    <a
                                                        href="https://api.whatsapp.com/send?phone={{ $media->whats_app }}&amp;text= Hi..!">
                                                        <i class="fa-brands fa-whatsapp"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            @if (!empty($media->linkedin))
                                                <div class="media_icon" style="background-color: #1b96bd;">
                                                    <a href="{{ $media->linkedin }}">
                                                        <i class="fa-brands fa-linkedin-in mr-2"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            @if (!empty($media->facebook))
                                                <div class="media_icon" style="background-color: #136095;">
                                                    <a href="{{ $media->facebook }}">
                                                        <i class="fa-brands fab fa-facebook"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            @if (!empty($media->instagram))
                                                <div class="media_icon" style="background-color: #99182d;">
                                                    <a href="{{ $media->instagram }}">
                                                        <i class="fa-brands fab fa-instagram"></i>
                                                    </a>
                                                </div>
                                            @endif
                                            @if (!empty($media->youtube))
                                                <div class="media_icon" style="background-color: #0b9018;">
                                                    <a href="{{ $media->youtube }}">
                                                        <i class="fa-brands fab fa-youtube"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-buttom container-fluid py-3">
            <div class="row">
                <div class="footer text-center text-white">
                    <div> &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        <a href="{{ url('') }}">Bhoopalam </a>
                        All Right Reserved.& Designed with <i class="fa fa-heart"></i> by <a
                            href="https://web2progress.com/" target="_blank"> web2progress</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- AOS  -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script src="https://alexandrebuffet.fr/codepen/slider/slick-animation.min.js"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <!-- AOS  -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#form').submit(function(e) {
                e.preventDefault();
                $(".nloading").show();
                if ($('#newsLatter').val() != '') {
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: "{{ url('/sendNewsLatter') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            if (response.status == true) {
                                $(".nloading").hide();
                                Lobibox.notify('success', {
                                    pauseDelayOnHover: true,
                                    continueDelayOnInactiveTab: false,
                                    position: 'top right',
                                    icon: 'bx bx-check-circle',
                                    msg: data
                                });
                            }
                        },
                        error: function(data) {
                            $(".nloading").hide();
                        }
                    });
                } else {
                    Lobibox.notify('success', {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: 'bx bx-check-circle',
                        msg: 'something went wrong'
                    });
                    $(".nloading").hide();
                }

            })

            $('#booking-s').submit(function(e) {
                e.preventDefault();

                $(".eq_submit").html('Sending <span class="fa fa-spinner fa-spin"></span>');
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('/bookNow') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        if (response.status == true) {
                            $(".eq_submit").html('SEND');
                            $('#PayModal').modal('hide');
                            Lobibox.notify('success', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                icon: 'bx bx-check-circle',
                                msg: response.msg
                            });
                        } else {
                            $(".eq_submit").html('SEND');

                            Lobibox.notify('error', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                icon: 'bx bx-check-circle',
                                msg: response.msg
                            });
                        }
                    },
                    error: function(data) {
                        $(".eq_submit").html(
                            'Sending <span class="fa fa-spinner fa-spin"></span>');
                    }
                });
            })

        })
    </script>
    <script>
        $(document).ready(function() {

            // $(document).on('blur', '#search', function() {
            //      $('#list').hide(1500);
            // });
            // $(document).on('focus', '#search', function() {
            //     $('#list').show();
            // });

            // udae data
            $(document).on('keyup', '#search', function() {
                //  alert($(this).val());
                $('#list').show();
                $.ajax({
                    method: "get",
                    url: "{{ route('autocomplete') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        value: $(this).val()
                    },
                    success: function(data) {
                        $('#list').html(data);
                    }
                });
            });
        });



        $(document).ready(function() {
            $(document).on('click', '.send-eq', function() {
                var element = $(this);
                var data = element.attr('data-title');
                $('#subject').val(data);
            })
        })
    </script>
@show
