@extends('admin.layouts.layouts')
@section('title', 'Blog - Post')
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
    <div class="container-fluid product-ourt pt-4">
        <div class="container-fluid">
            <!-- create post  -->
            <!-- error alert  -->
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <p aria-hidden="true">&times;</p>
                        </button>
                    </div>
                @endforeach
            @endif

            <!-- success alert  -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <p aria-hidden="true">&times;</p>
                    </button>
                </div>
            @endif

            <form action="{{ route('blog-post.store') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="text-left">
                    <div class="row">
                        <div class="col-sm-5">
                            <!-- seo -->
                            <div class="btn-group btn-sm btn-group" role="group" aria-label="First group">
                                <p class="btn">SEO URL Rank</p>
                                <p id="url-miter" class="btn text-light">0</p>
                                <p class="btn bg-green"> / 62</p>
                                <p id="seo_average" class="btn text-light">No</p>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <h4 class="mt-2">Create Post</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="forms-inputs w-100">
                                    <span>Post Title*</span>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ old('title') }}" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Enter post Name
                                    </div>
                                    <div class="text-danger">
                                        {{ $errors->first('title') }}
                                    </div>
                                </div>
                                <div class="forms-inputs-select mt-2">
                                    <span for="basic-url">Your Auto Generated URL</span>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <i class="input-group-text m-hide border-0 pr-1"
                                                id="basic-addon3">{{ url('') }}</i>
                                        </div>
                                        <input type="text" name="slug" id="slug"
                                            class="form-control border-0 pl-1" value="{{ old('slug') }}"
                                            autocomplete="off" placeholder="Auto Generate Post url*"
                                            aria-describedby="basic-addon3" required readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="mb-3"> <button v-on:click.stop.prevent="submit"
                                class="btn btn-dark w-100 mt-3">Create</button>
                        </div>
                    </div>
                </div>
            </form>

            <!--end create post  -->
            <!-- DataTales  -->
            <div class="btn-group btn-group-sm m-2">
                <a class="btn btn-dark" href="{{ route('blog-post.index') }}">All Posts({{ $allpost }})</a>
                <a class="btn btn-success" href="{{ route('blog-post.index') }}"> Publish({{ $publish }}) </a>
                <a class="btn btn-danger" href="{{ route('blog-post.draft') }}"
                    class="text-dark">Draft({{ $draft }})</a>
            </div>

            <table id="dataTable" class="table table-bordered w-100">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Keyword</th>
                        <th>Description</th>
                        <th>View</th>
                        <th>status</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--  post-->
@endsection
<!--start FOOTER  -->
{{-- FOOTER --}}
@section('footer-script')
    @parent
    <!-- Datatables JS-->
	<!--plugins-->
	<script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>



    <!-- Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            // udae data
            function update_data(id, column_title, value) {

                //alert(id+column_title+value);
                $.ajax({
                    url: "{{ url('/updatePost') }}",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        column_title: column_title,
                        value: value
                    },
                    success: function(data) {
                        // $('#altMSG').html(
                        //     '<div class="alert-success">' +
                        //     data + '</div>');
                    }
                });
                setInterval(function() {
                    $('#altMSG').html('');
                }, 5000);
            }
            $("#dataTable").on("keyup", '.update', function() {
                var id = $(this).data("id");
                var column_title = $(this).data("column");
                var value = $(this).text();
                update_data(id, column_title, value);
            });




            // DataTable
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                "order": [0, 'desc'],
                'ordering': true,
                ajax: "{{ route('post.data') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'slug'
                    },
                    {
                        data: 'keyword'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'view'
                    },
                    {
                        data: 'status'
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
        $(document).ready(function() {
            // nav togggled
            $('.accordion').addClass('toggled');

            $('#url-miter, #seo_average').css("background-color", "#aa0505");
            // create slug
            $('#title').keyup(function() {
                var text = $(this).val();
                text = text.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                    .toLowerCase() //replace all special characters | symbols with a space
                    .replace(/^\s+|\s+$/gm, '') // trim spaces at start and end of string
                    .replace(/\s+/g, '-'); // replace space with dash/hyphen
                $('#slug').val(text);
                // seo



                var length = text.length;
                $('#url-miter').text(length);
                if (length < 15) {
                    $('#url-miter, #seo_average').css("background-color", "#aa0505");
                    $('#seo_average').text("bad");
                } else if (length <= 30) {
                    $('#url-miter, #seo_average').css("background-color", "#ff7900");
                    $('#seo_average').text("Good");
                } else if (length <= 45) {
                    $('#url-miter, #seo_average').css("background-color", "#020285");
                    $('#seo_average').text("Very Good");
                } else if (length <= 62) {
                    $('#url-miter, #seo_average').css("background-color", "green");
                    $('#seo_average').text("Excelent");
                } else if (length <= 63) {
                    $('#url-miter, #seo_average').css("background-color", "#aa0505");
                    $('#seo_average').text("Bad Url");
                }


            });
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
                        url: "{{ route('RecycleBinPost') }}",
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
