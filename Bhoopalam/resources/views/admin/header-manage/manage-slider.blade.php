@extends('admin.layouts.layouts')
@section('title', 'Manage Slider')
@section('header-link')
@parent

<!-- Custom styles for this page -->
@endsection
<style>
    .galleryAlbum {
        width: 100%;
        height: 100px;
        position: relative;
        overflow: hidden;
        z-index: 1;
        border: 1px solid #2f2525;
    }
    .galleryAlbum .delete {
        position: absolute;
        padding: 18px 5px;
        text-align: center;
        border-radius: 22px;
        background-color: #fbfffe !important;
        top: 0px;
        z-index: 999;
        line-height: 18px;
        color: #9c0404 !important;
    }
    .galleryAlbum .delete i{
        margin-top: -11px;
        margin-left: 2px;
    }
    .activeSlide {
        width: 100%;
        color: #000000;
        text-shadow: 1px 1px 1px black;
        font-size: 20px;
        height: 100%;
        background-color: #ffffff94;
        padding: 40px 0px;
        text-align: center;
        cursor: pointer;
        border-radius: 2px;
        top: 0px;
        position: absolute;
    }
</style>
@section('content')
@parent
<!-- body code  -->
<div class="container-fluid">
    <div class="p-2">
        <div class="text-center  mb-4 float-right">
            <h4>UPLOAD Slider</h4>
            <span>Batter Look Image Size = 1880*1057px</span>
        </div>
        <div class="row">
            <!-- add slider  -->
            <form id="uploadIMG" action="javascript:void(0)" enctype="multipart/form-data" method="POST">
                <div class="mt-4">
                    <div class="forms-inputs">
                        <span class="mb-4">Add Image</span>
                    </div>
                </div>
                @csrf
                <input type="file" id="img" name="img[]" class="form-control" multiple accept="image/jpg, image/png, image/jpeg">
            </form>
        </div>
        <span id="imgView"></span>
        <!--end UPLOAD IMAGE  -->
        <!-- DataTales  -->
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Slider</h6>
        </div>
        <!-- get slider  -->
        <div class="w-100 card p-5 pt-2" id="slider"></div>
    </div>

</div>
<!--end body code  -->
@endsection
<!--start FOOTER  -->
{{-- FOOTER --}}
@section('footer-script')
    @parent
<!--================ End Footer Area =================-->
<!-- Bootstrap core JavaScript-->
<script>
    $(document).ready(function() {
        // load slider by id ajax
        // ajax get normal data
         $('#slider').load("{{route('manage-slider.create')}}");
        // img post
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#uploadIMG').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            // waiting alt
            $("#imgView").html('<i class="fas fa-spinner fa-spin"></i>Please Wait..');
            $.ajax({
                type: 'POST',
                url: "{{route('manage-slider.store')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    $("#imgView").html('<span class="text-success alt">' + data + '</span>');
                    // call load slider
                       $('#slider').load("{{route('manage-slider.create')}}");
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
        $("#img").on("change", function() {
            $("#uploadIMG").submit();
        });



    });
</script>

@endsection
