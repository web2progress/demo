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
    <style>
        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }

        /* The css styles for `outline` do not follow `border-radius` on iOS/Safari (#979). */
        .cropper-view-box {
            outline: 0;
            box-shadow: 0 0 0 1px #39f;
        }

        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            text-align: center;
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }


        .section {
            margin-top: 150px;
            background: #fff;
            padding: 50px 30px;
        }

        .modal-lg {
            max-width: 1000px !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css">
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
                    <form id="profileupdate" action="javascript:void(0)" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="text-right">Edit your profile</h6>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label class="labels">Full Name</label>
                                            <input type="text" class="form-control" id="name"
                                                onkeydown="return /[a-z]/i.test(event.key)" placeholder="Full name"
                                                name="name" value="{{ $user->name }}" required>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label class="labels">Mobile Number*</label>
                                            <input type="number" class="form-control" name="mo_number"
                                                pattern="[0-9]{1}[0-9]{9}" id="mobile" autocomplete="mobile"
                                                placeholder="mobile*" value="{{ $user->mo_number }}" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" id="email"
                                                autocomplete="email" placeholder="Email*" value="{{ $user->email }}"
                                                required>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label class="labels">Address </label>
                                            <textarea type="text" class="form-control" name="address" id="address" autocomplete="address" placeholder="address"
                                                required>{{ $user->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label class="labels">Zip/postal/City/State/Region</label>
                                            <input type="hidden" name="address_id" value="{{ $user->address_id }}"
                                                id="addressID">
                                            <input type="text" class="form-control" id="address_id"
                                                placeholder="type.. pincode or city" autocomplete="off"
                                                value="@if (!empty($user->uaddress->Pincode)){{ $user->uaddress->Pincode . '-' . $user->uaddress->City . '-' . $user->uaddress->District . '-' . $user->uaddress->State }}@endif"
                                                required>
                                            <div class="list-add"> </div>
                                        </div>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <button class="btn btn-primary" type="submit">Save
                                            Profile </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
    <script>
        $(document).ready(function() {
            var skeleton = [];
            for (var i = 1; i <= 9; i++) {
                skeleton.push('<span class="loading"></span>');
            }
            $(document).on('keydown', '#address_id', function() {
                $('.list-add').show();
                $.ajax({
                        url: "{{ route('user.address') }}",
                        method: "post",
                        data: {
                            'key': $(this).val(),
                            '_token': "{{ csrf_token() }}"
                        },
                        beforeSend: function() {
                            $('.list-add').html(skeleton);
                        }
                    }).done(function(response) {

                        $('.ajax-loading').hide();
                        $('.ajax-loading').html('');
                        if (response.status == true) {
                            $('.list-add').html(response.data);
                        } else {
                            $('.list-add').html('Data Not Found..');
                        }

                        $(document).on('click', '.add-address', function() {
                            $('#addressID').val($(this).data('id'));
                            $('#address_id').val($(this).data('attr'));
                            $('.list-add').hide();
                        });

                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        $('.ajax-loading').html('');
                        alert('No response from server');
                    });
            });
        });

        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;
        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
                file = files[0];

                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview',
            });

        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });


        $("#cropProfile").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 160,
                height: 160,
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('.profileImage').attr('src', base64data);
                    // $modal.modal('hide');

                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('user.profileUpload') }}",
                        data: {
                            '_token': "{{ csrf_token('') }}",
                            'image': base64data
                        },
                        success: function(response) {
                            if (response.status == true) {
                                $modal.modal('hide');
                                Lobibox.notify('success', {
                                    pauseDelayOnHover: true,
                                    continueDelayOnInactiveTab: false,
                                    position: 'top right',
                                    icon: 'bx bx-check-circle',
                                    msg: response.msg
                                });
                            } else {
                                Lobibox.notify('error', {
                                    pauseDelayOnHover: true,
                                    continueDelayOnInactiveTab: false,
                                    position: 'top right',
                                    icon: 'bx bx-check-circle',
                                    msg: response.msg
                                });
                            }
                        }
                    });
                }
            });
        });
        $('.uploadprofile').click(function() {
            $('.imgupload').trigger('click');
        });


        $('#profileupdate').submit(function() {
            var formData = new FormData(this);
            $.ajax({
                method: 'post',
                url: "{{ route('update-profile-details') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == true) {
                        Lobibox.notify('success', {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'bx bx-check-circle',
                            msg: response.msg
                        });
                    } else {
                        Lobibox.notify('warning', {
                            pauseDelayOnHover: true,
                            continueDelayOnInactiveTab: false,
                            position: 'top right',
                            icon: 'bx bx-check-circle',
                            msg: response.msg
                        });
                    }
                }


            })
        })
    </script>
@endsection
