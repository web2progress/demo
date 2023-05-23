@extends('admin.layouts.layouts')
@section('title', 'Blog - Draft')
@section('header-link')
    @parent
    <!--plugins-->
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
    <!-- custom link  -->
    <link rel="stylesheet" href="{{ asset('frontend/switch/css/bootstrap-switch-button.min.css') }}">
@endsection
@section('content')
@parent
<!-- body code  -->
<div class="container-fluid  product-ourt pt-4">
    <!-- DataTales  -->
    <div class="btn-group btn-group-sm m-2">
        <a class="btn btn-dark" href="{{ route('blog-post.index') }}">All Posts({{ $allpost }})</a>
        <a class="btn btn-success" href="{{ route('blog-post.index') }}"> Publish({{ $publish }}) </a>
        <a class="btn btn-danger" href="{{ route('blog-post.draft') }}"
            class="text-dark">Draft({{ $draft }})</a>
    </div>
    <!-- Content Row -->
    <div class="p-2">

        <table id="dataTable" class="table table-bordered w-100">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Keyword</th>
                    <th>Description</th>
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
            ajax: "{{route('draft.data')}}",
            columns: [{
                    data: 'id'
                },
                {
                    data: 'title'
                },
                {
                    data: 'keyword'
                },
                {
                    data: 'description'
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
                    url: "{{route('RecycleBinPost')}}",
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
