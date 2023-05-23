@extends('admin.layouts.layouts')
@section('title', 'Dashboard')
@section('header-link')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- custom link --}}
@endsection

@section('content')

    <?php

    $plans = DB::table('plans')->get();
    ?>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add New Plans
    </button>
    {{-- button end here --}}






    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Your Plan </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="dataForm" name="dataForm" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="control-label">Parameters </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="parameters" name="parameters"
                                            placeholder="Enter parameters" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="oprtype" class="control-label">PLAN ID</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="plan_id" name="plan_id"
                                            placeholder="Enter plan_id" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="oprname" class="control-label">Plan name</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="plan_name" name="plan_name"
                                            placeholder="Enter plan_name" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="plantype" class="control-label">Speed</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="speed" name="speed"
                                            placeholder="Enter speed" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="plantype" class="control-label">Additional</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="additional" name="additional"
                                            placeholder="Enter additional" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="amount" class="control-label">Amount for 1 Months</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="amount" name="amount"
                                            placeholder="Enter amount" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="amount" class="control-label">Amount for 3 Months</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="amount3" name="amount3"
                                            placeholder="Enter amount" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="amount" class="control-label">Amount for 6 Months</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="amount6" name="amount6"
                                            placeholder="Enter amount" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="amount" class="control-label">Amount for 12 Months</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="amount12" name="amount12"
                                            placeholder="Enter amount" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="oldamt" class="control-label">Fup</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="fup" name="fup"
                                            placeholder="Enter FUP" value="" maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="vdays" class="control-label">Beyound Fup</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="beyound_fup" name="beyound_fup"
                                            placeholder="Enter beyound_fup" value="" maxlength="50"
                                            required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="description" class="control-label">description</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="description" name="description"
                                            placeholder="Enter description" value="" maxlength="50"
                                            required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="slno" class="control-label">Applicability</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="applicability"
                                            name="applicability" placeholder="Enter Applicability" value=""
                                            maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="boxtype" class="control-label">Security Fees</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="security_fees"
                                            name="security_fees" placeholder="Enter security_fees" value=""
                                            maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="orn" class="control-label">Minimum period</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="minimum_period"
                                            name="minimum_period" placeholder="Enter minimum_period" value=""
                                            maxlength="50" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status" class="control-label">Free calls</label>
                                    <div class="col-sm-12">

                                        <input type="text" class="form-control" id="free_calls" name="free_calls"
                                            placeholder="Enter free_calls" value="" maxlength="50" required="">
                                    </div>



                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-sm-offset-2 col-sm-10 mt-2">
                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Create New
                        Plan</button>
                </div>
                </form>
            </div>

        </div>
    </div>





    <div class="container">
        <div class="row p-4">
            <table class="table me-4">
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>plan_id</th>
                        <th>Plan Name</th>
                        <th>Speed</th>
                        <th>FUP</th>
                        <th>Beyound FUP</th>
                        <th>Applicability</th>
                        <th>Security fees</th>
                        <th>Minimum Period</th>
                        <th>Additional</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td>{{ $plan->parameters }}</td>
                            <td>{{ $plan->plan_id }}</td>
                            <td>{{ $plan->plan_name }}</td>
                            <td>{{ $plan->speed }}</td>
                            <td>{{ $plan->fup }}</td>
                            <td>{{ $plan->beyound_fup }}</td>
                            <td>{{ $plan->applicability }}</td>
                            <td>{{ $plan->security_fees }}</td>
                            <td>{{ $plan->minimum_period }}</td>
                            <td>{{ $plan->additional }}</td>
                            <td>{{ $plan->amount }}</td>

                            <td><span><a href="#"><i class="fa-sharp fa-solid fa-pen"  data-bs-toggle="modal" data-bs-target="#exampleModal1"></i></a></span> <span><a
                                        href="#"><i class="fa-solid fa-eye"   data-bs-toggle="modal" data-bs-target="#exampleModal1"></i></a></span> <span><a  href="#"><i
                                            class="fa-sharp fa-solid fa-trash deleteData"  data-id="{{ $plan->id }}"></i></a></span></td>
                        </tr>

                        {{-- Model for Updation --}}



                        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Your Plan </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="dataForm" name="dataForm" class="form-horizontal" enctype="multipart/form-data"  action="{{url('updatePlan')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="id" value="{{$plan->id}}">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label">Parameters </label>
                                                        <div class="col-sm-12">
                                                            <input type="text"  data-id="{{ $plan->id }}" class="form-control update" id="parameters" name="parameters"
                                                                placeholder="Enter parameters" value="{{$plan->parameters}}" maxlength="50" required=""  data-column="parameters" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="oprtype" class="control-label">PLAN ID</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"   data-id="{{ $plan->id }}"  class="form-control update" id="plan_id" name="plan_id"
                                                                placeholder="Enter plan_id" value="{{$plan->plan_id}}" maxlength="50" required="" data-column="plan_id" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="oprname" class="control-label">Plan name</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"   data-id="{{ $plan->id }}"  class="form-control update" id="plan_name" name="plan_name"
                                                                placeholder="Enter plan_name" value="{{$plan->plan_name}}" maxlength="50" required="" data-column="plan_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="plantype" class="control-label">Speed</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"    data-id="{{ $plan->id }}"   class="form-control  update" id="speed" name="speed"
                                                                placeholder="Enter speed" value="{{$plan->speed}}" maxlength="50" required="" data-column="speed">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="plantype" class="control-label">Additional</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"    data-id="{{ $plan->id }}"   class="form-control update" id="additional" name="additional"
                                                                placeholder="Enter additional" value="{{$plan->additional}}" maxlength="50" required=""  data-column="additional">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="amount" class="control-label">Amount for 1 Months</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"   data-id="{{ $plan->id }}"   class="form-control update" id="amount" name="amount"
                                                                placeholder="Enter amount" value="{{$plan->amount}}" maxlength="50" required=""  data-column="amount">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="amount" class="control-label">Amount for 3 Months</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"   data-id="{{ $plan->id }}"   class="form-control update" id="amount3" name="amount3"
                                                                placeholder="Enter amount" value="{{$plan->amount3}}" maxlength="50" required=""  data-column="amount3">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="amount" class="control-label">Amount for 6 Months</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"     data-id="{{ $plan->id }}"   class="form-control update" id="amount6" name="amount6"
                                                                placeholder="Enter amount" value="{{$plan->amount6}}" maxlength="50" required=""  data-column="amount6">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="amount" class="control-label">Amount for 12 Months</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"   data-id="{{ $plan->id }}"   class="form-control update" id="amount12" name="amount12"
                                                                placeholder="Enter amount" value="{{$plan->amount12}}" maxlength="50" required=""   data-column="amount12">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="oldamt" class="control-label">Fup</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"  data-id="{{ $plan->id }}"   class="form-control update" id="fup" name="fup"
                                                                placeholder="Enter FUP" value="{{$plan->fup}}" maxlength="50" required=""  data-column="fup">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="vdays" class="control-label">Beyound Fup</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"   data-id="{{ $plan->id }}"   class="form-control update" id="beyound_fup" name="beyound_fup"
                                                                placeholder="Enter beyound_fup" value="{{$plan->beyound_fup}}" maxlength="50"
                                                                required=""  data-column="beyound_fup">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="description" class="control-label">description</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"    data-id="{{ $plan->id }}"   class="form-control update" id="description" name="description"
                                                                placeholder="Enter description" value="{{$plan->remarks}}" maxlength="50"
                                                                required=""  data-column="remarks">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="slno" class="control-label">Applicability</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"     data-id="{{ $plan->id }}"   class="form-control update" id="applicability"
                                                                name="applicability" placeholder="Enter Applicability" value="{{$plan->applicability}}"
                                                                maxlength="50" required=""  data-column="applicability">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="boxtype" class="control-label">Security Fees</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"   data-id="{{ $plan->id }}"    class="form-control update" id="security_fees"
                                                                name="security_fees" placeholder="Enter security_fees" value="{{$plan->security_fees}}"
                                                                maxlength="50" required=""  data-column="security_fees">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="orn" class="control-label">Minimum period</label>
                                                        <div class="col-sm-12">
                                                            <input type="text"     data-id="{{ $plan->id }}"  class="form-control update" id="minimum_period"
                                                                name="minimum_period" placeholder="Enter minimum_period" value="{{$plan->minimum_period}}"
                                                                maxlength="50" required=""  data-column="minimum_period">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="status" class="control-label">Free calls</label>
                                                        <div class="col-sm-12">

                                                            <input type="text"  data-id="{{ $plan->id }}"   class="form-control update" id="free_calls" name="free_calls"
                                                                placeholder="Enter free_calls" value="{{$plan->free_calls}}" maxlength="50" required=""  data-column="free_calls">
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-10 mt-2">
                                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Update
                                            </button>
                                    </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endsection


    @section('footer-script')
        @parent
        <script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('assets/js/index.js') }}"></script>


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




//   delete items from here


$('body').on('click', '.deleteData', function() {

                var id = $(this).data("id");
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {

                    if (willDelete) {

                        $.ajax({
                            type: "get",
                            url: "{{ url('delete-plan') }}" + '/' + id,
                            success: function(response) {
                                alert('success');
                                table.draw();
                                if (response.status == true) {
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

                            },
                        });
                        $(this).parents("tr").animate({
                                backgroundColor: "#003"
                            }, "slow")
                            .animate({
                                opacity: "hide"
                            }, "slow");
                        setInterval(function() {
                            $('#altMSG').html('');
                        }, 5000);
                    } else {

                        swal("Your imaginary file is safe!");
                    }
                });

            });



        </script>


    @endsection
