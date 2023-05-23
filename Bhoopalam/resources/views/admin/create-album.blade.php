@extends('admin.layouts.layouts')
@section('title', 'Album')
@section('header-link')
    @parent
    <!-- Custom styles for this page -->
    <link href="{{ asset('admin-assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @parent
    <!-- body code  -->
    <div class="container-fluid  product-ourt pt-4">
        <!-- create album  -->
        <!-- error alert  -->
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{$error}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @endif
        <!-- success alert  -->
        @if (session('success'))
            <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class="bx bxs-check-circle"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Success Alerts</h6>
                        <div class="text-white"> {{ session('success') }}!</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card p-2">
            <form action="/admin/addAlbum" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="text-center  mb-4 ">
                    <h4>Create Album</h4>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="forms-inputs w-100"> <span>Album Name*</span>
                                    <input type="text" name="album_title" id="album_title" class="form-control"
                                        value="{{ old('album_title') }}" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Enter Album Name
                                    </div>
                                    <p class="text-danger p-2">{{ $errors->first('album_title') }}
                                    <p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="forms-inputs w-100"> <span>Album Url*</span>
                                    <input type="text" name="album_slug" id="album_slug" class="form-control"
                                        value="{{ old('album_slug') }}" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Enter Album Url
                                    </div>
                                    <p class="text-danger p-2">{{ $errors->first('album_slug') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3"> <button type="submit"
                                        class="btn btn-dark w-100">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end create album  -->
            <!-- DataTales  -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All albums </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>images</th>
                            <th>Url</th>
                            <th>date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>images</th>
                            <th>Url</th>
                            <th>date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($albums as $album)
                            <tr>
                                <td contenteditable="true" class="update" data-id="{{ $album->id }}"
                                    data-column="album_title">{{ $album->album_title }}
                                </td>
                                <td>
                                    <!-- count image  -->
                                    &LeftAngleBracket;
                                    {{ App\Models\Gallery::where('album_id', $album->id)->count() }}
                                    &RightAngleBracket;
                                </td>
                                <td contenteditable="true" class="update" data-id="{{ $album->id }}"
                                    data-column="album_slug">{{ $album->album_slug }}</td>
                                <td>{{ $album->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="/admin/add-images/{{ $album->id }}"
                                                class="btn btn-secondary">Add image</a>
                                            <button type="button" class="btn btn-sm btn-danger text-light delete"
                                                id="{{ $album->id }}"><i class="lni lni-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <!-- {!! $albums->links() !!} -->
                    {!! $albums->appends(['sort' => 'department'])->links() !!}
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
    <!-- Page level plugins -->
    <!-- <script src="{{ asset('admin-assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> -->
    <script>
        // Call the dataTables jQuery plugin
        // $(document).ready(function() {
        //      $('#dataTable').DataTable({
        //           "ordering": false // false to disable sorting (or any other option)
        //      });
        // });
        $(document).ready(function() {
            // create slug
            $('#album_title').keyup(function() {
                var text = $(this).val();
                text = text.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                .toLowerCase() //replace all special characters | symbols with a space
                    .replace(/^\s+|\s+$/gm, '') // trim spaces at start and end of string
                    .replace(/\s+/g, '-'); // replace space with dash/hyphen
                $('#album_slug').val(text);
            });
            // udae data
            function update_data(id, column_title, value) {
                // alert(id+column_title+value);
                $.ajax({
                    url: "/admin/updateAlbum",
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
                            url: "{{ url('/admin/deleteAlbum') }}",
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
        });
    </script>
@endsection
