
@extends('admin.layouts.layouts')
@section('title', 'Dashboard')
@section('header-link')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- custom link --}}
@endsection
@section('content')
<style>
    img{
        height: 50px;
        width: 50px;
    }

   img:hover{

    height: 150px;
    width: 150px;
   }
</style>

<?php

$customers=  App\Models\ Customer::orderBy('id', 'DESC')->paginate(4);

?>





<div class="page-content">


    {{-- table content start --}}

    <section class="intro">
        <div class="gradient-custom-2 h-100">
          <div class="mask d-flex align-items-center h-100">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-12">
                  <div class="table-responsive">
                    <h3> All Customers</h3>
                    <table class="table  table-bordered mb-0">
                      <thead>
                        <tr class="bg-primary text-white">
                          <th scope="col">Name</th>
                          <th scope="col">Plan</th>
                          <th scope="col">Mobile</th>
                          <th scope="col">Status</th>
                          <th scope="col">Contact Person</th>
                          {{-- <th scope="col">Documents</th> --}}
                          <th scope="col">View</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($customers as $customer )


                        <tr>
                          <th scope="row">{{$customer->name}}</th>
                          <td>{{$customer->plan_name}}</td>
                          <td>{{$customer->phone}}</td>

                          <td>
                            <div class="mt-5">
                            <input data-id="{{ $customer->id }}" name="status" data-column="status" class="form-control update  change"   value="{{ $customer->status }}">
                           </div>
                        </td>
                        <td>
                            <div class="mt-5">
                            <input data-id="{{ $customer->id }}" name="contact_person" data-column="contact_person" class="form-control update pt-3 " rows="3"  value="{{ $customer->contact_person }}">
                           </div>
                        </td>
                          {{-- <td><span><img src="{{ asset('storage/files/customers/' . $customer->pan) }}" alt="pan"></span>&nbsp;&nbsp;<span><img src="{{ asset('storage/files/customers/' . $customer->aadhar) }}" alt="aadhar"></span></td> --}}
                          <td><a href="{{url('customerprofile/'.$customer->id)}}"><i class="fa-solid fa-eye"></i></a></td>
                        </tr>

                        @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

{{-- table content end --}}

   <div class="paginate  m-2">
{{$customers->links()}}
</div>




@endsection
@section('footer-script')
    @parent
    <script src="{{asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
    <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/js/index.js')}}"></script>

   <script>
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#dataForm').submit(function(e) {
            e.preventDefault();
            $('#exampleModal').modal('toggle');
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{ route('plans.store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    alert('data  saved successfully')
                },
                error: function(data) {
                    console.log(data);
                    alert('some error occured')

                }
            });
        });
        $("#thumb").on("change", function() {
            $("#productImageUpload").submit();
            // image view
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });







// updating the status and contact person here


$(document).ready(function() {
        // nav togggled
        $('.accordion').addClass('toggled');
        // udae data
        function update_data(id, column_title, value) {
            //alert(id+column_title+value);
            $.ajax({
                url: "{{ route('/updateCustomer') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    column_title: column_title,
                    value: value
                },
                success: function(data) {
                    $('#messageAlt').html('<div class="alert-success">' + data + '</div>');
                }
            });
        }

        // update post
        $(document).on("change", '.update', function() {
            var id = $(this).data("id");
            var column_title = $(this).data("column");
            var value = $(this).val();
            update_data(id, column_title, value);
        });

    });
   </script>
@endsection
