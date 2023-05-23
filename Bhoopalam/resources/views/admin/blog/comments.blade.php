@extends('admin.layouts.layouts')
@section('title', 'Comments')
@section('header-link')
    @parent
    <!-- custom link  -->

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
                <h6 class="m-0 font-weight-bold text-primary">All Comments </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>comments</th>
                            <th>date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>comments</th>
                            <th>date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->name }}</td>
                                <td>{{ $comment->email }}</td>
                                <td style="width:200px;white-space: initial">{{ $comment->comment }}</td>
                                <td>{{ $comment->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="action-comment btn-sm">
                                        <input value="{{ $comment->id }}" name="toggle" type="checkbox"
                                            data-toggle="switchbutton" {{ $comment->status == 'active' ? 'checked' : '' }}
                                            data-onlabel="Active" data-offlabel="In Active" data-onstyle="success"
                                            data-offstyle="danger" data-size="xs">
                                        <button type="button" class="btn btn-sm btn-danger text-light delete"
                                            id="{{ $comment->id }}"><i class="lni lni-trash"></i>
                                        </button>
                                        <a class="btn btn-primary" href="{{url('')}}/post/{{$comment->blogPost->slug}}#doReply">Go To Reply</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <!-- {!! $comments->links() !!} -->
                    {!! $comments->appends(['sort' => 'department'])->links() !!}
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
    <link rel="stylesheet" href="{{ asset('frontend/switch/css/bootstrap-switch-button.min.css') }}">
    <script src="{{ asset('frontend/switch/dist/bootstrap-switch-button.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('input[name=toggle]').change(function() {
                var mode = $(this).prop('checked');
                var id = $(this).val();
                //alert(id);
                $.ajax({
                    url: "{{ route('commentAprove') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        mode: mode,
                        id: id,
                    },
                    success: function(response) {
                        if (response.status) {
                            Lobibox.notify('success', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                icon: 'bx bx-check-circle',
                                msg: response.msg
                            });
                        } else {
                            Lobibox.notify('warning', {
                                pauseDelayOnHover: true,
                                continueDelayOnInactiveTab: false,
                                position: 'top right',
                                icon: 'bx bx-check-circle',
                                msg: response.msg
                            });
                        }
                    }
                })

            })
        })
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
                        url: "{{ route('delComment') }}",
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
