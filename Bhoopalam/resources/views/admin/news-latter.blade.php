@extends('admin.layouts.layouts')
@section('title', 'News Latter')
@section('header-link')
@parent
<!--plugins-->
<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
@parent
<!-- body code  -->
<div class="container-fluid  product-ourt pt-4">
    <!-- Content Row -->
    <div class="p-2">
        <div align="center">
            <a href="{{ route('export_excel.excel') }}" class="btn btn-success">Export to Excel</a>
        </div>
        <table id="dataTable" class="table table-bordered w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>date</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<!--end body code  -->
@endsection
<!--start FOOTER  -->
{{-- FOOTER --}}
@section('footer-script')
@parent
<!--================ End Footer Area =================-->
<!-- Datatables JS-->
<!--plugins-->
<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<!-- Script -->
<script type="text/javascript">
    $(document).ready(function() {
        // nav togggled
        $('.accordion').addClass('toggled');
        // DataTable
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            "order": [0, 'desc'],
            'ordering': true,
            ajax: "{{route('get.newslatter')}}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'email'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'action'
                },
            ]
        });
    });
</script>
<script>
    // delete
    $("#dataTable").on("click", ".delete", function() {
        var id = $(this).attr("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "{{url('/deleteNewsLatter')}}",
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
