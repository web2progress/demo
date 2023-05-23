@extends('layouts.app')
@section('title', 'About Us')
@section('header')
@parent
<style>
    .formcontainer{
        display: flex;
        justify-content: center;
    }
    .hide{
        visibility: hidden;
    }
    .see{
        visibility: visible;
    }
</style>
<!-- external  -->
<link rel="stylesheet" href="{{asset('assets/f-book/css/style.css')}}">
@endsection
@section('content')

<div class="container">
    <section style="background-color: #eee;">
        <div class="container py-5">
          <div class="row">
            <div class="col">
              <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                <ol class="breadcrumb mb-0">
                  <li class="breadcrumb-item"><a href="/">Home</a></li>
                  <li class="breadcrumb-item"><a href="#" >User</a></li>
                  <li class="breadcrumb-item active" aria-current="page" >
                    <a href="#"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Update Profile
                       </a></li>
                </ol>
              </nav>
            </div>
            <div>
            <button id="pdf"   class="btn btn-success  float-end mb-4" onclick="pdf()">View All Plans</button>
        </div>
          </div>

          {{-- profile model start here  --}}

<!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

              <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Profile Update</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="profileUpload" action="javascript:void(0)" enctype="multipart/form-data" method="POST">
                @csrf
          <input type="file"  name="profile"  id="profile">
          <input type="hidden" id="pan_id" name="id" value="{{$customer->id}}">
        </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>

      </div>
    </div>
  </div>


          {{-- profile model end here --}}
          <div class="row">
            <div class="col-lg-4">
              <div class="card mb-4">
                <div class="card-body text-center">
                  <img src="{{ $customer->profile ? url('storage/files/customers/profile/' .$customer->profile) : asset('storage/files/customers/profile/profile.png') }}" alt="avatar"
                    class="rounded-circle img-fluid" style="width: 150px;">
                  <h5 class="my-3">{{$customer->name}}</h5>
                  <p class="text-muted mb-1"> Your Plan is  {{$customer->plan_name}}</p>
                  <p class="text-muted mb-4">Thanks </p>

                </div>
              </div>

            </div>
            <div class="col-lg-8">
              <div class="card mb-4">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Full Name</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$customer->name}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$customer->email}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Phone</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$customer->phone}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Plan Name</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$customer->plan_name}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Status</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$customer->status}}</p>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <p class="mb-0">Contact Person</p>
                    </div>
                    <div class="col-sm-9">
                      <p class="text-muted mb-0">{{$customer->contact_person}}</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card mb-4 mb-md-0">
                    <div class="card-body">
                        <div class="upper d-flex justify-content-between ms-4">
                        <h4> Pan Card</h4>



                        </div>


                        <form id="ImageUpload" action="javascript:void(0)" enctype="multipart/form-data" method="POST">

                            <div class="mt-4">


                                <img id="image_preview" src="{{ $customer->pan ? url('storage/files/customers/' .$customer->pan) : asset('assets/images/thumbnail.jpg') }}" alt="preview image" style="max-height: 150px;">
                            </div>
                            @csrf
                            <input type="hidden" id="pan_id" name="id" value="{{$customer->id}}">
                            <input type="file" id="thumb" name="pan" class="form-control">
                        </form>





                      <div class="progress rounded mb-2" style="height: 5px;">
                        <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="66"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card mb-4 mb-md-0">



                {{-- updating aadhar here --}}
                <div class="card-body">
                    <div class="upper d-flex justify-content-between ms-4">
                    <h4> Aadhar Card</h4>



                    </div>


                    <form id="ImageUpload2" action="javascript:void(0)" enctype="multipart/form-data" method="POST">

                        <div class="mt-4">


                            <img id="image_preview2" src="{{ $customer->aadhar ? url('storage/files/customers/' .$customer->aadhar) : asset('assets/images/thumbnail.jpg') }}" alt="preview image" style="max-height: 150px;">
                        </div>
                        @csrf
                        <input type="hidden" id="aadhar_id" name="id" value="{{$customer->id}}">
                        <input type="file" id="thumb2" name="aadhar" class="form-control">
                    </form>





                  <div class="progress rounded mb-2" style="height: 5px;">
                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="66"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</div>
@endsection
@section('footer')
@parent
<script>

    function pdf(){
        window.open('storage/files/customers/plans.pdf');
    }
</script>
<script>
$(document).ready(function(e) {

$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // change pan card
        $('#ImageUpload').submit(function(e) {

            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{url('customer/ImageUpload')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    alert('Pan Card uploaded');
                },
                error: function(data) {
                    alert('some error occured');
                    console.log(data);
                }
            });
        });
        $("#thumb").on("change", function() {

            $("#ImageUpload").submit();
            // image view
            let reader = new FileReader();

            reader.onload = (e) => {
                $('#image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });






    });
</script>



{{-- profile update here  --}}

<script>
    $(document).ready(function(e) {

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // change pan card
            $('#profileUpload').submit(function(e) {

                e.preventDefault();

               $("#exampleModal").hide();
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "{{url('customer/profileUpload')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert('Profile  Updated');
                    },
                    error: function(data) {
                        alert('some error occured');
                        console.log(data);
                    }
                });
            });
            $("#profile").on("change", function() {

                $("#profileUpload").submit();

            });






        });
    </script>



{{-- profile successfully updated --}}
<script>
    $(document).ready(function(e) {

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            // change pan card
            $('#ImageUpload2').submit(function(e) {

                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "{{url('customer/ImageUpload')}}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert('Aadhar uploaded');
                    },
                    error: function(data) {
                        alert('some error occured');
                        console.log(data);
                    }
                });
            });
            $("#thumb2").on("change", function() {

                $("#ImageUpload2").submit();
                // image view
                let reader = new FileReader();

                reader.onload = (e) => {
                    $('#image_preview2').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });





            // Change Addhar Card



        });
    </script>
@endsection
