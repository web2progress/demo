@extends('admin.layouts.layouts')
@section('header-link')
@section('title', 'Page')
@section('header-link')
    @parent
    <!-- custom link  -->

@endsection
@section('content')
    <!-- body code  -->
    <div class="container-fluid product-ourt pt-4">
        <!--  page-->
        @if(!empty($editPages))
            <div class="row ">
                <div class="col-sm-8">
                    <h2 class="m-4">Page</h2>
                </div>
                <div class="col-sm-4">
                    <div class="d-flex justify-content-end">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" data-id="{{$editPages->id}}" data-column="status" value="draft"
                                    class="btn btn-primary clickUpdate">Draft
                            </button>
                            <button type="button" data-id="{{$editPages->id}}" data-column="status" value="publish"
                                    class="btn btn-success clickUpdate">publish
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row ">
                <div class="col-sm-9">

                    <!--    title-->
                    <div class="forms-inputs w-100"><span>Title*</span>
                        <input type="text" data-id="{{$editPages->id}}" data-column="title" class="form-control update"
                               value="{{$editPages->title}}" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Enter Title
                        </div>
                        <p class="text-danger p-2">{{{ $errors->first('title') }}}
                        <p>
                    </div>
                    <!--    url-->
                    <div class="forms-inputs w-100"><span>URL*</span>
                        <input type="text" data-id="{{$editPages->id}}" data-column="slug" class="form-control update"
                               value="{{$editPages->slug}}" autocomplete="off" required>
                        <div class="invalid-feedback">
                            Enter url
                        </div>
                        <p class="text-danger p-2">{{{ $errors->first('url') }}}
                        <p>
                    </div>
                    <textarea id="editor" class="form-control update">{{$editPages->content}}</textarea>
                </div>
                <div class="col-sm-3">
                    <!-- keywords     -->
                    <div class="">
                        <div class="forms-inputs">
                            <span class="mb-4">keywords</span>
                        </div>
                        <textarea data-id="{{$editPages->id}}" data-column="keyword"
                                  class="form-control update pt-3 keyword" rows="10"
                                  placeholder="Type, any, keyword, using comma,">{{$editPages->keyword}}</textarea>
                        <span class="keyword-outer"><span id="keyword-miter">0</span> / 17</span>
                    </div>
                    <!-- Description     -->
                    <div class="mt-4">
                        <div class="forms-inputs">
                            <span class="mb-4">Description</span>
                        </div>
                        <textarea data-id="{{$editPages->id}}" data-column="description"
                                  class="form-control update pt-3 description"
                                  rows="10">{{$editPages->description}}</textarea>
                        <span class="description-outer"><span id="description-miter"></span> / 155</span>
                    </div>

                    <!-- Thumbnail     -->
                    <div class="mt-4">
                        <form id="thumUpload" action="javascript:void(0)" enctype="multipart/form-data" method="post">
                            <div class="mt-4">
                                <div class="forms-inputs">
                                    <span class="mb-4">Thumbnail</span>
                                </div>
                                <img id="image_preview"
                                     src="{{ $editPages->thumbnail ? url('images/'.$editPages->thumbnail) : url('images/thumbnail.jpg') }}"
                                     alt="preview image" style="max-height: 150px;">
                            </div>
                            @csrf
                            <input type="hidden" id="id" name="id" value="{{$editPages->id}}">
                            <input type="file" id="thumb" name="thumbnail" class="form-control">
                        </form>

                    </div>
                </div>


            </div>
        @else
            <!-- if not edit create title  -->
            <div class="container-fluid">
                <!-- create page  -->
                <!-- error alert  -->
                <!-- @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
{{$error}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <p aria-hidden="true">&times;</p>
                    </button>
               </div>

                    @endforeach
                @endif -->

                <!-- success alert  -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <p aria-hidden="true">&times;</p>
                        </button>
                    </div>
                @endif

                <form action="{{ route('createPageTitle') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="text-left">
                        <div class="row">
                            <div class="col-sm-4">
                                <!-- seo -->
                                <div class="btn-group btn-group" role="group" aria-label="First group">
                                    <p class="p-2">SEO URL Rank</p>
                                    <p id="url-miter" class="btn text-light">0</p>
                                    <p class="btn bg-green"> / 62</p>
                                    <p id="seo_average" class="btn text-light">No</p>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <h4>Create Page</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="forms-inputs w-100">
                                        <span>Page Title*</span>
                                        <input type="text" name="title" id="title" class="form-control"
                                               value="{{ old('title') }}" autocomplete="off" required>
                                        <div class="invalid-feedback">
                                            Enter page Name
                                        </div>
                                        <div class="text-danger">
                                            {{{ $errors->first('title') }}}
                                        </div>
                                    </div>
                                    <div class="forms-inputs-select mt-2">
                                        <span for="basic-url">Your Auto Generated URL</span>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="input-group-text m-hide border-0 pr-1"
                                                   id="basic-addon3">{{ url('') }}/</i>
                                            </div>
                                            <input type="text" name="slug" id="slug" class="form-control border-0 pl-1"
                                                   value="{{ old('slug') }}" autocomplete="off"
                                                   placeholder="Auto Generate Page url*" aria-describedby="basic-addon3"
                                                   required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="mb-3">
                                <button v-on:click.stop.prevent="submit" class="btn btn-dark w-100">Create</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!--end create page  -->
                <!-- DataTales  -->
                <div class="btn-group btn-group-sm m-2">
                    <a class="btn btn-dark" href="{{url('dashboard/create-page')}}">All Pages({{$allpage}})</a>

                    <a class="btn btn-success" href="{{url('dashboard/create-page')}}"> Publish({{$publish}}) </a>

                    <a class="btn btn-danger" href="{{url('dashboard/draft')}}" class="text-dark">Draft({{$draft}})</a>

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
        @endif
    </div>
    <!--  page-->
    <!--end body code  -->
@endsection
<!--start FOOTER  -->
{{-- FOOTER --}}
@section('footer-script')
    @parent
    @if(!empty($editPages))
        <!--================ End Footer Area =================-->
        <script type="text/javascript">
            $(document).ready(function (e) {
                //keyword seo param
                var keyTarget = '.keyword';
                var keyLength = $(".keyword").val().split(",").length - 1;

                getKeyParm(keyLength, keyTarget);

                $('.keyword').keyup(function () {
                    // get keyword lenth
                    var keyLength = $(this).val().split(",").length - 1;
                    getKeyParm(keyLength, keyTarget);
                });
                //description seo param
                var descTarget = '.description';
                var descLength = $(".description").val().length;
                getDescParm(descLength, descTarget);
                $('.description').keyup(function () {
                    var descLength = $(this).val().length;
                    getDescParm(descLength, descTarget);
                });

                // keyword param seo
                function getKeyParm(keyLength, keyTarget) {
                    $('#keyword-miter').text(keyLength);
                    if (keyLength < 2) {
                        $(keyTarget).css("border-image", "linear-gradient(to right, #da9f9f 25%, #cceaea 25%, #cceaea 50%,#cceaea 50%, #cceaea 75%, #cceaea 75%) 5");
                    } else if (keyLength <= 6) {
                        $(keyTarget).css("border-image", "linear-gradient(to right, #f6c23e 25%, #f6c23e 25%, #cceaea 50%,#cceaea 50%, #cceaea 75%, #cceaea 75%) 5");
                    } else if (keyLength <= 10) {
                        $(keyTarget).css("border-image", " linear-gradient(to right, #f6c23e 25%, #f6c23e 25%, #1cc88a 50%,#1cc88a 50%, #cceaea 75%, #cceaea 75%) 5");
                    } else if (keyLength <= 14) {
                        $(keyTarget).css("border-image", "linear-gradient(to right, #11a616 25%, #11a616 25%, #4effb5 50%,#3ef69a 50%, #65f1b0 75%, #62efad 75%) 5");
                    } else if (keyLength <= 17) {
                        $(keyTarget).css("border-image", "linear-gradient(to right, #11a616 25%, #11a616 25%, #11a616 50%,#11a616 50%, #19ad24 75%, #11a616 75%) 5");
                    } else if (keyLength <= 20) {
                        $(keyTarget).css("border-image", "linear-gradient(to right, rgb(255 0 0) 25%, rgb(255 0 0) 25%, rgb(255 33 0) 50%, rgb(255 9 0) 50%, rgb(255 0 0) 75%, rgb(255 1 0) 75%) 5 / 1 / 0 stretch");
                    }
                }

                //description param seo
                function getDescParm(descLength, descTarget) {
                    $('#description-miter').text(descLength);
                    if (descLength < 32) {
                        $(descTarget).css("border-image", "linear-gradient(to right, #da9f9f 25%, #cceaea 25%, #cceaea 50%,#cceaea 50%, #cceaea 75%, #cceaea 75%) 5");
                    } else if (descLength <= 64) {
                        $(descTarget).css("border-image", "linear-gradient(to right, #f6c23e 25%, #f6c23e 25%, #cceaea 50%,#cceaea 50%, #cceaea 75%, #cceaea 75%) 5");
                    } else if (descLength <= 96) {
                        $(descTarget).css("border-image", " linear-gradient(to right, #f6c23e 25%, #f6c23e 25%, #1cc88a 50%,#1cc88a 50%, #cceaea 75%, #cceaea 75%) 5");
                    } else if (descLength <= 128) {
                        $(descTarget).css("border-image", "linear-gradient(to right, #11a616 25%, #11a616 25%, #4effb5 50%,#3ef69a 50%, #65f1b0 75%, #62efad 75%) 5");
                    } else if (descLength <= 155) {
                        $(descTarget).css("border-image", "linear-gradient(to right, #11a616 25%, #11a616 25%, #11a616 50%,#11a616 50%, #19ad24 75%, #11a616 75%) 5");
                    } else if (descLength <= 160) {
                        $(descTarget).css("border-image", "linear-gradient(to right, rgb(255 0 0) 25%, rgb(255 0 0) 25%, rgb(255 33 0) 50%, rgb(255 9 0) 50%, rgb(255 0 0) 75%, rgb(255 1 0) 75%) 5 / 1 / 0 stretch");
                    }
                }

                // thumbnail page
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#thumUpload').submit(function (e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    $.ajax({
                        type: 'post',
                        url: "{{url('/ajaxImageUploadPage')}}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            this.reset();
                            // alert('<span class="text-success alt">' + data + '</span>');
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                });
                $("#thumb").on("change", function () {
                    $("#thumUpload").submit();
                    // image view
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#image_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                // nav togggled
                $('.accordion').addClass('toggled');

                // udae data
                function update_data(id, column_title, value) {
                    //alert(id+column_title+value);
                    $.ajax({
                        url: "{{url('admin/updatePage')}}",
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id,
                            column_title: column_title,
                            value: value
                        },
                        success: function (data) {
                            // $('#altMSG').html(
                            //     '<div class="alert-success">' +
                            //     data + '</div>');
                        }
                    });
                    setInterval(function () {
                        $('#altMSG').html('');
                    }, 5000);
                }

                $(document).on("keyup", '.update', function () {
                    var id = $(this).data("id");
                    var column_title = $(this).data("column");
                    var value = $(this).val();
                    update_data(id, column_title, value);
                });

                $(document).on("click", '.clickUpdate', function () {
                    var id = $(this).data("id");
                    var column_title = $(this).data("column");
                    var value = $(this).val();
                    update_data(id, column_title, value);
                    if (value == 'draft') {
                        swal("Darft!", "Now Your Page In Draft");
                    }
                    if (value == 'publish') {
                        swal("publish!", "Now Your Page Published");
                    }


                });


                // ckeditor ////////////////////////////////////////////////////
                var editor = CKEDITOR.replace('editor', {
                    height: 400,
                    uiColor: '#ffffff',
                    filebrowserUploadUrl: "{{route('ckeditor.image_upload', ['_token' => csrf_token() ])}}",
                    filebrowserUploadMethod: 'form',

                    // "filebrowserBrowseUrl": "{{asset('ckfinder\/ckfinder.html')}}",
                    // "filebrowserImageBrowseUrl": "{{asset('ckfinder\/ckfinder.html?type=Images')}}",
                    // "filebrowserFlashBrowseUrl": "{{asset('ckfinder\/ckfinder.html?type=Flash')}}",
                    // "filebrowserUploadUrl": "{{asset('ckfinder\/core/connector\/php/connector.php?command=QuickUpload&type=Files')}}",
                    // "filebrowserImageUploadUrl": "{{asset('ckfinder\/core/connectorVphp\/connector.php?command=QuickUpload&type=Images')}}",
                    // "filebrowserFlashUploadUrl": "{{asset('ckfinder\/coreV/connector\/php\/connector.php?command=QuickUpload&type=Flash')}}",

                });

                editor.on("pluginsLoaded", function (event) {
                    editor.on('contentDom', function (evt) {
                        var editable = editor.editable();
                        editable.attachListener(editable, 'keyup', function (e) {
                            // do something
                            var self = this;
                            var id = $('#id').val();
                            var column_title = 'content';
                            var value = self.getData()
                            update_data(id, column_title, value);
                            // $('#altMSG').text(value + id);
                        });
                    });
                });
                // end ckeditor /////////////////////////
            });
        </script>

        <!-- ck editor  -->
        <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    @else
        <!-- Datatables JS-->
        <!--plugins-->
        <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>

        <!-- Script -->
        <script type="text/javascript">
            $(document).ready(function () {
                // udae data
                function update_data(id, column_title, value) {

                    //alert(id+column_title+value);
                    $.ajax({
                        url: "{{url('/updatePage')}}",
                        method: "post",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id,
                            column_title: column_title,
                            value: value
                        },
                        success: function (data) {
                            // $('#altMSG').html(
                            //     '<div class="alert-success">' +
                            //     data + '</div>');
                        }
                    });
                    setInterval(function () {
                        $('#altMSG').html('');
                    }, 5000);
                }

                $("#dataTable").on("keyup", '.update', function () {
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
                    ajax: "{{route('page.data')}}",
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
            $(document).ready(function () {
                // nav togggled
                $('.accordion').addClass('toggled');

                $('#url-miter, #seo_average').css("background-color", "#aa0505");
                // create slug
                $('#title').keyup(function () {
                    var text = $(this).val();
                    text = text.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase() //replace all special characters | symbols with a space
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
            $("#dataTable").on("click", ".delete", function () {
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
                            url: "{{route('deletePagePost')}}",
                            method: "post",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id
                            },
                            success: function (data) {
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
                        setInterval(function () {
                            $('#altMSG').html('');
                        }, 5000);
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });

            });
        </script>

    @endif

@endsection
