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
        <div class="p-2">
            <!--end create post  -->
            <!-- DataTales  -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Enquiry Details </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>number</th>
                            <th>subject</th>
                            <th>Message</th>
                            <th>date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>name</th>
                            <th>email</th>
                            <th>number</th>
                            <th>subject </th>
                            <th>Message</th>
                            <th>date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($enquiry as $enq)
                            <tr>
                                <td>{{ $enq->name }}</td>
                                <td>{{ $enq->email }}</td>
                                <td>{{ $enq->phone }}</td>
                                <td>{{ $enq->subject }}</td>
                                <td>{{ $enq->message }}</td>
                                <td>{{ $enq->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <p class="file">
                                            <button type="bu tton" class="btn btn-sm btn-danger text-light delete"
                                                id="{{ $enq->id }}"><i class="lni lni-trash"></i>
                                            </button>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <!-- {!! $enquiry->links() !!} -->
                    {!! $enquiry->appends(['sort' => 'department'])->links() !!}
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
        // delete
        $("#dataTable").on("click", ".delete", function() {
            var id = $(this).attr("id");
            swal({
                title: "Are you sure?",
                text: "Once you delete       d, booking detail. you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ url('/admin/deleteDetails') }}",
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
