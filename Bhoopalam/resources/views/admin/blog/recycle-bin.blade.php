@extends('admin.layouts.layouts')
@section('title', 'Blog - Recycle Bin')
@section('header-link')
    @parent
    <!-- custom link  -->
    <link rel="stylesheet" href="{{ asset('frontend/switch/css/bootstrap-switch-button.min.css') }}">
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
            <h6 class="m-0 font-weight-bold text-primary">All Posts </h6>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Keyword</th>
                        <th>Description</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Keyword</th>
                        <th>Description</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->title}}</td>
                        <td>{{$post->keyword}}</td>
                        <td>{{$post->description}}</td>
                        <td>{{$post->created_at->format('d/m/Y')}}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <p class="file">

                                    <button type="button" class="btn btn-sm btn-success text-light restore" id="{{$post->id}}">restore </button>

                                    <button type="button" class="btn btn-sm btn-danger text-light delete" id="{{$post->id}}"><i class="lni lni-trash"></i>
                                    </button>
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <!-- {!! $posts->links() !!} -->
                {!! $posts->appends(['sort' => 'department'])->links() !!}
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
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: "{{route('deletePost')}}",
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

           // restore
           $("#dataTable").on("click", ".restore", function() {
        var id = $(this).attr("id");

        swal({
            title: "Are you sure?",
            text: "Once restore, you will see your imaginary file in Draft!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: "{{route('restorePost')}}",
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
