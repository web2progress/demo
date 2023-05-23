@extends('admin.layouts.layouts')
@section('title', 'Booking Details')
@section('header-link')
@parent
@endsection
@section('content')
@parent
<!-- body code  -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="mt-5">
        <!--end create post  -->
        <!-- DataTales  -->
        <div class="card-header py-3 d-flex mt-5">
            <h6 class="m-0 font-weight-bold text-primary">All Booking Details </h6> <span class="ml-5" id="altMSG"></span>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered responsive text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>email</th>
                        <th>number</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>name</th>
                        <th>email</th>
                        <th>number</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody class="text-center">
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{$booking->name}}</td>
                        <td>{{$booking->email}}</td>
                        <td>{{$booking->phone}}</td>
                        <td>{{$booking->message}}</td>
                        <td contenteditable="true" data-id="{{$booking->id}}" data-column="status" class="@if(empty($booking->status)) bg-warning @endif update">{{$booking->status}}</td>
                        <td>{{$booking->created_at->format('d/m/Y')}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <p class="file">
                                    <button type="button" class="btn btn-sm btn-danger text-light delete" id="{{$booking->id}}"><i class="lni lni-trash"></i>
                                    </button>
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <!-- {!! $bookings->links() !!} -->
                {!! $bookings->appends(['sort' => 'department'])->links() !!}
            </div>
        </div>
    </div>
</div>
<!--end body code  -->
@endsection
<!--start FOOTER  -->
{{-- FOOTER --}}
@section('footer-script')
@parent
<!--================ End Footer Area =================-->
<script>
    $(document).ready(function() {
        $('.chiller-theme').removeClass('toggled');
        // udae data
        function update_data(id, column_title, value) {
            $.ajax({
                url: "/admin/updateBookinStatus",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    column_title: column_title,
                    value: value
                },
                success: function(data) {
                    $('#altMSG').html(
                        '<div class="alert-success">' +
                        data + '</div>');
                }
            });
            setInterval(function() {
                $('#altMSG').html('');
            }, 5000);
        }
        $(document).on('keyup ', '.update', function() {
            var id = $(this).data("id");
            var column_title = $(this).data("column");
            var value = $(this).text();
            update_data(id, column_title, value);
        });
    })
    // delete
    $("#dataTable").on("click", ".delete", function() {
        var id = $(this).attr("id");
        swal({
            title: "Are you sure?",
            text: "Once you deleted, booking detail. you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{url('/admin/deleteBookingDetails')}}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(data) {
                        // show allert
                        swal(data, {
                            icon: "success",
                        })
                    }
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
