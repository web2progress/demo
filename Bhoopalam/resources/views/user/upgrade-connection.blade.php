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
    <!-- body  -->
    <div class="container-fluid bg-light">
        <div class="row p-0 border-bottom dashboard_header">
            @include('user.__sidebar-dashboard')
            <div class="col-sm-6 px-4">
                @php
                    $user = App\Models\ConnectionUpgrade::where('user_id', auth()->user()->id)
                        ->where('status', 'pending')
                        ->get();

                @endphp
                @if ($user->Count() > 0)
                    <table class="table">
                        <tr>
                            <th class="text-center" colspan="6">Application Submission Details</th>
                        </tr>
                        @foreach ($user as $key=>$conn)
                            <tr>
                                <th>Application Id</th>
                                <td>{{ $conn->application_id }}</td>
                                <th>Date</th>
                                <td>{{ $conn->created_at->format('d-M-Y') }}</td>
                                <th>Status</th>
                                <td>{{$conn->status}}</td>
                            </tr>
                        @endforeach

                    </table>
                @else
                    <form action="{{ route('upgradePlan') }}" method="post" class="needs-validation"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <h3 style="padding: 9px 0px;">Existing Users</h3>
                        <div class="form-group mt-2">
                            <input for="name" class="form-control" name="fullname" placeholder="Full Name*" required>
                            <div class="invalid-feedback">
                                Please Enter Your Full Name.
                            </div>
                        </div>
                        <!-- mobileNumber -->
                        <div class="form-group mt-2">
                            <input type="number" class="form-control" name="mobileNumber" id="form-group11"
                                placeholder="Enter Your Number" required>
                            <div class="invalid-feedback">
                                Please Enter Your Mobile Number.
                            </div>
                        </div>
                        <!-- company name -->
                        <div class="form-group mt-2">
                            <input type="text" class="form-control" name="companyname" placeholder="Enter Company Name*"
                                id="fa-check" required>
                        </div>
                        <!-- Display Name -->
                        <div class="form-group mt-2">
                            <input type="text" class="form-control" name="address" placeholder="Address*" id="address"
                                required>
                        </div>
                        <!-- Alternate Number -->

                        <div class="form-group mt-2">
                            <input type="number" class="form-control" name="altMobileNumber" id="form-group11"
                                placeholder="Mobile Number" required>
                        </div>
                        <!-- form apload -->

                        <label class="mt-2">Upload Request:</label>
                        <div id="request_docAlt"></div>
                        <img id="request_docImage" src="" class="img-fluid d-none">
                        <div class="form-group">
                            <input type="file" name="request_doc" class="form-control wizard-required" id="request_doc"
                                accept="image/png, image/jpg, image/jpeg," required>
                            <i for="request_doc" title="Select image" class="wizard-form-text-label">Upload Your request
                                document*</i>
                            <div class="wizard-form-error"></div>
                        </div>

                        <!-- =====two=== -->

                        <label class="mt-2">Upload Application:</label>
                        <div id="applicationAlt"></div>
                        <img id="applicationImage" src="" class="img-fluid d-none">
                        <div class="form-group">
                            <input type="file" name="application" class="form-control wizard-required" id="application"
                                accept="image/png, image/jpg, image/jpeg," required>
                            <i for="application" title="Select image" class="wizard-form-text-label">
                                Upload Your Application Document*</i>
                            <div class="wizard-form-error"></div>
                        </div>

                        <button type="submit" class="btn btn-success mt-2" id="buttan-buttan">Submit</button>

                    </form>
                @endif

            </div>
        </div>
    </div>
    <!-- end body  -->
@endsection
@section('footer')
    @parent
    <script>
        $(document).ready(function() {



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





            $(document).on('change', '#request_doc', function() {
                var id = '#request_docAlt';
                var fileSizeOrg = this.files[0].size;
                var fileSize = this.files[0].size;
                var message = '.request_docMessage';
                var image = '#request_docImage';
                fileSizeMap(id, fileSize, fileSizeOrg, message, image);

                if (fileSizeOrg > 1000000) {
                    $("#request_doc").val('');
                    $('#request_docImage').attr('src', '');
                } else {
                    // image view
                    let reader = new FileReader();
                    reader.readAsDataURL(this.files[0]);
                }
            });

            $(document).on('change', '#application', function() {
                var id = '#applicationAlt'
                var fileSizeOrg = this.files[0].size;
                var fileSize = this.files[0].size;
                var message = '.applicationMessage';
                var image = '#applicationImage';
                fileSizeMap(id, fileSize, fileSizeOrg, message, image);

                if (fileSizeOrg > 1000000) {
                    $("#application").val('');
                    $('#applicationImage').attr('src', '');
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
