@extends('admin.layouts.layouts')
@section('title', 'Album')
@section('header-link')
    @parent
    <meta name="_token" content="{{ csrf_token() }}">
    <style>
        .galleryAlbum {
            height: 100px;
            overflow: hidden;
            position: relative;
            z-index: 1;
            border: 1px solid #2f2525;
        }
        .galleryAlbum img {
            width: 100%;
            height: 100%;
        }
        .galleryAlbum .delete {
            position: absolute;
            padding: 4px 7px;
            text-align: center;
            border-radius: 22px;
            background-color: #fbfffe !important;
            right: 0px;
            top: 4px;
            z-index: 999;
            line-height: 18px;
            color: #9c0404 !important;
        }
    </style>
    <!-- Custom styles for this page -->
    <link href="{{asset('assets/file-uploader/jquery.growl.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/file-uploader/fileup.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @parent
    <!-- body code  -->
    <div class="container-fluid">
        <h4>UPLOAD IMAGE ({{$albums->album_title}})</h4>
            <button type="button" class="btn btn-success fileup-btn">
                Select images
                <input type="hidden" id="post_id" name="id" value="{{$albums->id}}">
                <input type="file" id="upload-3" name="img[]" multiple accept="image/*"/>
            </button>
            <div id="upload-3-queue" class="queue"></div>
            <span id="imgView"></span>
            <!--end UPLOAD IMAGE  -->
            <!-- DataTales  -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All albums </h6>
            </div>
            <!-- get gallery  -->
            <div class="w-100" id="gallery"></div>
        </div>
    </div>
    <!--end body code  -->
@endsection
{{-- FOOTER --}}
@section('footer-script')
    @parent
    <!--================ End Footer Area =================-->
    <script src="{{asset('assets/file-uploader/jquery.growl.js')}}"></script>
    <script src="{{asset('assets/file-uploader/fileup.js')}}"></script>
    <script>
        $(document).ready(function () {
            // load gallery by id ajax
            var id = '{{$albums->id}}';
            // create funcion load gallery
            loadGallery(id);
            // call function gallery
            function loadGallery(id) {
                $.ajax({
                    method: "POST",
                    url: "/admin/fetchGallery",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    success: function (data) {
                        $("#gallery").html(data);
                    }
                });
            }
            // end call function gallery
            // ajax get normal data
            // $('#gallery').load("/fetchGallery");
        $.fileup({
            url: "{{url('/admin/ImageUpload')}}",
            inputID: "upload-3",
            queueID: "upload-3-queue",
            autostart: true,
            onSelect: function (file) {
                $("#types .control-button").show();
            },
            onRemove: function (file, total) {
                if (file === "*" || total === 1) {
                    $("#types .control-button").hide();
                }
            },
            onSuccess: function (response, file_number, file) {
                var result = $.parseJSON(response);
                $.growl.notice({title:result.msg, message: file.name});
                // call load gallery
                loadGallery(id);
            },
            onError: function (event, file, file_number) {
                $.growl.error({message: "Upload error!"});
                // call load gallery
                loadGallery(id);
            },
        });
        });
    </script>
@endsection
