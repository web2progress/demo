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
    <meta property="og:url" content="{{ url('/') }}/">
    <meta property="og:title" content="title">
    <meta property="og:image" content="{{ url('/') }}/image.jpg">
    <meta property="og:site_name" content="site name">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="title">
    <meta property="twitter:description" content="description">
    <meta property="twitter:image" content="{{ url('/') }}/image.jpg">
    @parent
    <!--other link-->
@endsection
@section('content')


    <!-- body  -->
    <div class="container">
        <div class="head   align-items-center text-center py-4">
            <h2 class="text-success"> Welcome To Bhoopalam Plans</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="">
                        <th scope="col">Plan Parameter</th>
                        <th scope="col">Plan Id</th>
                        <th scope="col">Plan Name</th>
                        <th scope="col">Speed</th>
                        <th>FUP</th>
                        <th> Beyond FUP</th>
                        <th>Applicablity</th>
                        <th>Security Fees</th>
                        <th> Miniume Time</th>
                        <th> Amount for Monthly Plan</th>
                        <th>Amount on 3 Months</th>

                        <th>Amount on 6 Months</th>
                        <th> Amount on Yearly Plan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> {{ $plan->parameters }}</td>
                        <td> {{ $plan->plan_id }}</td>
                        <td> {{ $plan->plan_name }}</td>
                        <td> {{ $plan->speed }}</td>
                        <td> {{ $plan->fup }}</td>
                        <td> {{ $plan->beyound_fup }}</td>
                        <td> {{ $plan->applicability }}</td>
                        <td> {{ $plan->security_fees }}</td>
                        <td> {{ $plan->minimum_period }}</td>
                        <td> {{ $plan->amount }}</td>
                        <td> {{ $plan->amount3 }}</td>
                        <td> {{ $plan->amount6 }}</td>
                        <td> {{ $plan->amount12 }}</td>

                    </tr>
                </tbody>
            </table>

        </div>


        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
            Get Plan
        </button>

        <!-- Modal -->
        <form id="CustomerAdd" action="{{ url('/CustomerAdd') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Please fill this form to get Plan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Mobile Number</label>
                                <input type="number" class="form-control" id="number" placeholder="Enter Mobile"
                                    max="9999999999" min="6666666666" name="mobile" onkeyup="NumberCheck(this.value)"
                                    onkeydown="NumberCheck(this.value)" required>
                                <small class="small d-none" style="color:red">This number already excits please try
                                    different number to get the plan</small>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Aadhar Card</label>
                                <input type="file" class="form-control" id="exampleFormControlInput1" name="aadhar">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Pan Card</label>
                                <input type="file" class="form-control" id="exampleFormControlInput1" name="pan">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Plan Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1"
                                    placeholder="Enter Email" name="planname" value="{{ $plan->plan_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Remarks</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remark"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary  subbtn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>








        <!-- end body  -->
    @endsection
    @section('footer')
        @parent
        <!--================ End Footer Area =================-->

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#CustomerAdd').submit(function(e) {
                e.preventDefault(e);
                $('#exampleModal').modal('hide').data('bs.modal', null);


                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ url('/CustomerAdd') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert('you get this plan  successfully');
                    },
                    error: function(data) {
                        alert('some error occured to get plan');
                        console.log(data);
                    }
                });
            });



            //    checking number excits in databse por not


            function NumberCheck(value) {

                $.ajax({
                    type: "get",
                    url: "/number_exists/" + value,
                    dataType: "json",
                    success: function(msg) {
                        if (msg.msg == 'success') {
                            $('.small').removeClass('d-none');
                            $('.subbtn').addClass('d-none');
                        } else {
                            $('.small').addClass('d-none');
                            $('.subbtn').removeClass('d-none');
                        }
                    }
                });

            }
        </script>

    @endsection
