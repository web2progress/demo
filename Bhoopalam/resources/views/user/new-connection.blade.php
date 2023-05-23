@extends('layouts.app')
@section('title', 'New Connection')
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
    <div class="container-fluid bg-light">
        <div class="row p-0 border-bottom dashboard_header">
            @include('user.__sidebar-dashboard')
            <div class="col-sm-9">
                @php
                    $user = App\Models\ConnectionApply::where('user_id', auth()->user()->id)
                        ->where('status', 'pending')
                        ->get();

                @endphp
                @if ($user->Count() > 0)
                    <table class="table">
                        <tr>
                            <th class="text-center" colspan="6">Application Submission Details</th>
                        </tr>
                        @foreach ($user as $key => $conn)
                            <tr>
                                <th>Application Id</th>
                                <td>{{ $conn->application_id }}</td>
                                <th>Date</th>
                                <td>{{ $conn->created_at->format('d-M-Y') }}</td>
                                <th>Status</th>
                                <td>{{ $conn->status }}</td>
                            </tr>
                        @endforeach

                    </table>
                @else
                    <div id="form-wizard" class="form-wizard">
                        <form id="newConnectionForm" method="post" action="{{ url('user/new-connection-registration') }}"
                            class="px-3" enctype="multipart/form-data">
                            @csrf
                            <div class="form-wizard-header">
                                <h3>Registration Form</h3>
                                <ul class="list-unstyled form-wizard-steps clearfix">
                                    <li class="active"><span>1</span></li>
                                    <li><span>2</span></li>
                                    <li><span>3</span></li>
                                    <li><span>4</span></li>
                                </ul>
                            </div>
                            <div class="text-dark11">
                                <ul>
                                    <li>New Connections</li>
                                    <li>Upload Application Residential</li>
                                    <li> Upload compny rentalDocument</li>
                            </div><br>
                            <fieldset class="wizard-fieldset show">
                                <h5 style="padding: 0px 19px;">New Connections</h5>
                                <div class="row">
                                    <!-- Full Name  -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required" name="fullname"
                                                id="fullname"  required>
                                            <label for="fullname" class="wizard-form-text-label">Full Name*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <!-- Display Name -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required" name="address"
                                                id="address" required>
                                            <label for="address" class="wizard-form-text-label">Address*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <!-- Email -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" id="email" required>
                                            <label for="email" class="wizard-form-text-label">Email*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <!-- Mobile Number -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="number" class="form-control wizard-required" pattern="^[0-9]{5,15}$" name="mobileNumber" id="mobileNumber" required>
                                            <label for="mobileNumber" class="wizard-form-text-label">Number*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <!-- Alternate Number -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="altMobileNumber" pattern="^[0-9]{5,15}$"
                                                id="altMobileNumber" required>
                                            <label for="altMobileNumber" class="wizard-form-text-label">Alternet Mobile
                                                Number</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <!-- pin code* -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required" name="pincode"
                                                id="pincode" required>
                                            <label for="pincode" class="wizard-form-text-label">Pin Code*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <!-- area* -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required" name="area"
                                                id="area" required>
                                            <label for="area" class="wizard-form-text-label">Enter You Area*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <!-- company* -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required" name="companyname"
                                                id="companyname" required>
                                            <label for="companyname" class="wizard-form-text-label">Enter Company
                                                Name*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <!-- extention* -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required" name="extention"
                                                id="extention" required>
                                            <label for="extention" class="wizard-form-text-label">Enter Your
                                                Extention</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <!-- extention* -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control wizard-required"
                                                name="doorNoAndstreet" id="doornoAndstreet" required>
                                            <label for="doornoAndstreet" class="wizard-form-text-label">Door No And
                                                Street</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix  ">
                                    <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                </div>
                            </fieldset>


                            <fieldset class="wizard-fieldset">
                                <h5 style="padding: 0px 19px;">Upload Application Residential <small
                                        class="text-warning bg-dark pl-2 pr-2">JPG, PNG, UP To 500kb</small>
                                </h5>
                                <div class="row">
                                    <!-- Upload your rentalDocument pic*  -->
                                    <div class="col-sm-4">
                                        <div id="rentalAlt"></div>
                                        <img id="rentalDocumentImage" src="" class="img-fluid d-none">
                                        <div class="form-group">
                                            <input type="file" name="rentalDocument"
                                                class="form-control wizard-required" id="rentalDocument"
                                                accept="image/png, image/jpg, image/jpeg," required>
                                            <label for="rentalDocument" title="Select image"
                                                class="wizard-form-text-label">Upload Rental document*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <!-- Upload your PAN Card*  -->
                                    <div class="col-sm-4">
                                        <div id="panAlt"></div>
                                        <img id="panCardImage" src="" class="img-fluid d-none">
                                        <div class="form-group">
                                            <input type="file" name="panCard" class="form-control wizard-required"
                                                id="panCard" accept="image/png, image/jpg, image/jpeg," required>
                                            <label for="panCard" title="Select image"
                                                class="wizard-form-text-label">Upload
                                                Your
                                                Pan Card Image*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                    <!-- Upload your Adhar Card*  -->
                                    <div class="col-sm-4">
                                        <div id="adharAlt"></div>
                                        <img id="adharCardImage" src="" class="img-fluid d-none">
                                        <div class="form-group">
                                            <input type="file" name="adharCard" class="form-control wizard-required"
                                                id="adharCard" accept="image/png, image/jpg, image/jpeg," required>
                                            <label for="adharCard" title="Select image" class="wizard-form-text-label">
                                                Upload Your Adhar Card Image*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                    <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                </div>
                            </fieldset>
                            <fieldset class="wizard-fieldset">
                                <h5 style="padding: 0px 19px;">Upload Company Documnets <small
                                        class="text-warning bg-dark pl-2 pr-2">JPG, PNG, UP To 500kb</small>
                                </h5>
                                <div class="row">
                                    <!-- Upload your rentalDocument pic*  -->
                                    <!-- Upload your companyRegistration Card*  -->
                                    <div class="col-sm-4">
                                        <div id="companyRegistrationAlt"></div>
                                        <img id="companyRegistrationDocImage" src="" class="img-fluid d-none">
                                        <div class="form-group">
                                            <input type="file" name="companyRegistrationDoc"
                                                class="form-control wizard-required" id="companyRegistrationDoc"
                                                accept="image/png, image/jpg, image/jpeg," required>
                                            <label for="companyRegistrationDoc" title="Select image"
                                                class="wizard-form-text-label">
                                                Upload Your Company Registration*</label>
                                            <div class="wizard-form-error"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group clearfix">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                    <a href="javascript:;" class="form-wizard-next-btn float-right">Next</a>
                                </div>
                            </fieldset>
                            <fieldset id="submitALT" class="wizard-fieldset">
                                <div class="ss-form-outer">
                                    <h2 class="text-center">Now Your Form Is Ready To Submit</h2>
                                    <div class="row justify-content-center">
                                        <img class="right-img" src="/images/right123.jpg1.png" class="fit-image">
                                    </div>
                                    <h3 class="text-center">Click On Submit Button</h3>
                                </div>
                                <div class="justify-content-center h3 lazyAlert"></div>
                                <div class="form-group clearfix">
                                    <a href="javascript:;" class="form-wizard-previous-btn float-left">Previous</a>
                                    <a href="javascript:;" class="form-wizard-submit float-right">Submit</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>

@endsection
@section('footer')
    @parent
    <script>
        $(document).ready(function() {

            // $('#newConnectionForm').submit(function() {
            //     $(".lazyAlert").html('<img src="/images/loading.gif"><span class="mt-2 ml-3">Please Wait..</span>');
            //     var formData = new FormData(this);
            //     $.ajax({
            //         method:'POST',
            //         url:"{{ url('new-connection-registration') }}",
            //         data:formData,
            //         cache:false,
            //         contentType:false,
            //         processData:false,
            //         success: function(response) {
            //             if (response.status) {
            //                 $("#form-wizard").html(response.msg);
            //                 setInterval(function() {
            //                     window.location.href = '/';
            //                 }, 40000);
            //             } else {
            //                 $(".lazyAlert").html(response.msg);
            //             }
            //         }
            //     });
            // });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            // check data size
            function fileSizeMap(id, fileSize, fileSizeOrg, message, image) {
                $(message).html('');
                var fileExtension = new Array('Bytes', 'KB', 'MB', 'GB'),
                    i = 0;
                while (fileSize > 900) {
                    fileSize /= 1024;
                    i++;
                }
                var getSize = (Math.round(fileSize * 100) / 100) + ' ' + fileExtension[i];

                if (fileSizeOrg > 1000000) {
                    $(id).html('<small class="text-danger text-center"> File Size =' + getSize +
                        ', Allow Under 1MB Only</small>');
                    $(image).removeClass('d-block');
                    $(image).addClass('d-none');
                    $(message).html(
                        '<span class="text-danger">Upload Failed...<i class="fas fa-times-circle"></i></span>');
                } else {
                    $(id).html('<small class="text-success text-center"> File Size =' + getSize +
                        ', Accepted</small>');
                }
            }


            //  upload rentalDocument image with file size
            $(document).on('change', '#rentalDocument', function() {
                var id = '#rentalAlt';
                var fileSizeOrg = this.files[0].size;
                var fileSize = this.files[0].size;
                var message = '.rentalDocumentMessage';
                var image = '#rentalDocumentImage';
                fileSizeMap(id, fileSize, fileSizeOrg, message, image);

                if (fileSizeOrg > 1000000) {
                    $('#rentalDocumentImage').attr('src', '');
                } else {
                    // image view
                    let reader = new FileReader();
                    reader.readAsDataURL(this.files[0]);
                }
            });





            $(document).on('change', '#panCard', function() {
                var id = '#panAlt';
                var fileSizeOrg = this.files[0].size;
                var fileSize = this.files[0].size;
                var message = '.panCardMessage';
                var image = '#panCardImage';
                fileSizeMap(id, fileSize, fileSizeOrg, message, image);

                if (fileSizeOrg > 1000000) {
                    $("#panCard").val('');
                    $('#panCardImage').attr('src', '');
                } else {
                    // image view
                    let reader = new FileReader();
                    reader.readAsDataURL(this.files[0]);
                }
            });

            $(document).on('change', '#adharCard', function() {
                var id = '#adharAlt'
                var fileSizeOrg = this.files[0].size;
                var fileSize = this.files[0].size;
                var message = '.adharCardMessage';
                var image = '#adharCardImage';
                fileSizeMap(id, fileSize, fileSizeOrg, message, image);

                if (fileSizeOrg > 1000000) {
                    $("#adharCard").val('');
                    $('#adharCardImage').attr('src', '');
                } else {
                    // image view
                    let reader = new FileReader();
                    reader.readAsDataURL(this.files[0]);
                }
            });

            $(document).on('change', '#companyRegistrationDoc', function() {
                var id = '#companyRegistrationAlt'
                var fileSizeOrg = this.files[0].size;
                var fileSize = this.files[0].size;
                var message = '.companyRegistrationDocMessage';
                var image = '#companyRegistrationDocImage';
                fileSizeMap(id, fileSize, fileSizeOrg, message, image);

                if (fileSizeOrg > 1000000) {
                    $("#companyRegistrationDoc").val('');
                    $('#companyRegistrationDocImage').attr('src', '');
                } else {
                    // image view
                    let reader = new FileReader();
                    reader.readAsDataURL(this.files[0]);
                }
            });




        });


        jQuery(document).ready(function() {
            // click on next button
            jQuery('.form-wizard-next-btn').click(function() {
                var parentFieldset = jQuery(this).parents('.wizard-fieldset');
                var currentActiveStep = jQuery(this).parents('.form-wizard').find(
                    '.form-wizard-steps .active');
                var next = jQuery(this);
                var nextWizardStep = true;
                parentFieldset.find('.wizard-required').each(function() {
                    var thisValue = jQuery(this).val();

                    if (thisValue == "") {
                        jQuery(this).siblings(".wizard-form-error").slideDown();
                        nextWizardStep = false;
                    } else {
                        jQuery(this).siblings(".wizard-form-error").slideUp();
                    }
                });
                if (nextWizardStep) {
                    next.parents('.wizard-fieldset').removeClass("show", "400");
                    currentActiveStep.removeClass('active').addClass('activated').next().addClass('active',
                        "400");
                    next.parents('.wizard-fieldset').next('.wizard-fieldset').addClass("show", "400");
                    jQuery(document).find('.wizard-fieldset').each(function() {
                        if (jQuery(this).hasClass('show')) {
                            var formAtrr = jQuery(this).attr('data-tab-content');
                            jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(
                                function() {
                                    if (jQuery(this).attr('data-attr') == formAtrr) {
                                        jQuery(this).addClass('active');
                                        var innerWidth = jQuery(this).innerWidth();
                                        var position = jQuery(this).position();
                                        jQuery(document).find('.form-wizard-step-move').css({
                                            "left": position.left,
                                            "width": innerWidth
                                        });
                                    } else {
                                        jQuery(this).removeClass('active');
                                    }
                                });
                        }
                    });
                }
            });
            //click on previous button
            jQuery('.form-wizard-previous-btn').click(function() {
                var counter = parseInt(jQuery(".wizard-counter").text());;
                var prev = jQuery(this);
                var currentActiveStep = jQuery(this).parents('.form-wizard').find(
                    '.form-wizard-steps .active');
                prev.parents('.wizard-fieldset').removeClass("show", "400");
                prev.parents('.wizard-fieldset').prev('.wizard-fieldset').addClass("show", "400");
                currentActiveStep.removeClass('active').prev().removeClass('activated').addClass('active',
                    "400");
                jQuery(document).find('.wizard-fieldset').each(function() {
                    if (jQuery(this).hasClass('show')) {
                        var formAtrr = jQuery(this).attr('data-tab-content');
                        jQuery(document).find('.form-wizard-steps .form-wizard-step-item').each(
                            function() {
                                if (jQuery(this).attr('data-attr') == formAtrr) {
                                    jQuery(this).addClass('active');
                                    var innerWidth = jQuery(this).innerWidth();
                                    var position = jQuery(this).position();
                                    jQuery(document).find('.form-wizard-step-move').css({
                                        "left": position.left,
                                        "width": innerWidth
                                    });
                                } else {
                                    jQuery(this).removeClass('active');
                                }
                            });
                    }
                });
            });

            jQuery(document).on("click", ".form-wizard .form-wizard-submit", function() {
                var currentActiveStep = jQuery(this).parents('.form-wizard').find(
                    '.form-wizard-steps .active');
                $('#newConnectionForm').submit();

            });
            // focus on input field check empty or not
            jQuery(".form-control").on('focus', function() {
                var tmpThis = jQuery(this).val();
                if (tmpThis == '') {
                    jQuery(this).parent().addClass("focus-input");
                } else if (tmpThis != '') {
                    jQuery(this).parent().addClass("focus-input");
                }
            }).on('blur', function() {
                var tmpThis = jQuery(this).val();
                if (tmpThis == '') {
                    jQuery(this).parent().removeClass("focus-input");
                    jQuery(this).siblings('.wizard-form-error').slideDown("3000");
                } else if (tmpThis != '') {
                    jQuery(this).parent().addClass("focus-input");
                    jQuery(this).siblings('.wizard-form-error').slideUp("3000");
                }
            });
        });
    </script>
@endsection
