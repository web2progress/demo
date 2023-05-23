@extends('admin.layouts.layouts')
@section('title', 'Product Category')
@section('header-link')
    @parent
@endsection
@section('content')
    @parent
    <!-- body code  -->
    <div class="container-fluid product-ourt ">
        <button type="button" class="btn btn-info btn-sm">Total Category || {{$allProductCat}}</button>
        <!-- create category  -->
        <!-- error alert  -->
        <div class="col-sm-6">
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
        </div>
        <div class="p-2">
            <form action="/admin/addProductCategory" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="text-center  mb-4 ">
                    <h4>Create Product Category</h4>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="forms-inputs w-100"><span>Category Name*</span>
                                    <input type="text" name="cat_title" id="cat_title" class="form-control"
                                           value="{{ old('cat_title') }}" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Enter Category Name
                                    </div>
                                    <p class="text-danger p-2">{{{ $errors->first('cat_title') }}}
                                    <p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="forms-inputs w-100"><span>Category Url*</span>
                                    <input type="text" name="cat_slug" id="cat_slug" class="form-control"
                                           value="{{ old('cat_slug') }}" autocomplete="off" required>
                                    <div class="invalid-feedback">
                                        Enter Category Url
                                    </div>
                                    <p class="text-danger p-2">{{{ $errors->first('cat_slug') }}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="forms-inputs mb-4 w-100"><span>Category Keyword</span>
                                    <textarea type="text" name="cat_keyword"
                                              class="form-control">{{ old('cat_keyword') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="forms-inputs mb-4 w-100"><span>Category Description</span>
                                    <textarea type="text" name="cat_description"
                                              class="form-control">{{ old('cat_description') }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <button v-on:click.stop.prevent="submit" class="btn btn-dark w-100">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end create category  -->
            <!-- DataTales  -->
            <div class="-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Product Categories </h6>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Keyword</th>
                        <th>Description</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Keyword</th>
                        <th>Description</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td contenteditable="true" class="update" data-id="{{$product->id}}"
                                data-column="product_cat_title">{{$product->product_cat_title}}</td>
                            <td contenteditable="true" class="update" data-id="{{$product->id}}"
                                data-column="product_cat_slug">{{$product->product_cat_slug}}</td>
                            <td contenteditable="true" class="update" data-id="{{$product->id}}"
                                data-column="product_cat_keyword">{{$product->product_cat_keyword}}</td>
                            <td contenteditable="true" class="update" data-id="{{$product->id}}"
                                data-column="product_cat_description">{{$product->product_cat_description}}</td>
                            <td>{{$product->created_at->format('d/m/Y')}}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <p class="file">
                                        <button type="button" class="btn btn-sm btn-danger text-light delete"
                                                id="{{$product->id}}"><i class="lni lni-trash"></i>
                                        </button>
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <!-- {!! $products->links() !!} -->
                    {!! $products->appends(['sort' => 'department'])->links() !!}
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
    <!-- <script src="{{asset('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script> -->
    <script>
        // Call the dataTables jQuery plugin
        // $(document).ready(function() {
        //      $('#dataTable').DataTable({
        //           "ordering": false // false to disable sorting (or any other option)
        //      });
        // });
        $(document).ready(function () {
            // create slug
            $('#cat_title').keyup(function () {
                var text = $(this).val();
                text = text.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase() //replace all special characters | symbols with a space
                    .replace(/^\s+|\s+$/gm, '') // trim spaces at start and end of string
                    .replace(/\s+/g, '-'); // replace space with dash/hyphen
                $('#cat_slug').val(text);
            });
            // udae data
            function update_data(id, column_title, value) {
                // alert(id+column_title+value);
                $.ajax({
                    url: "/admin/updateProductCategory",
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        column_title: column_title,
                        value: value
                    },
                    success: function (data) {
                        $('#altMSG').html(
                            '<div class="alert-success">' +
                            data + '</div>');
                    }
                });
                setInterval(function () {
                    $('#altMSG').html('');
                }, 5000);
            }
            $(document).on('keyup ', '.update', function () {
                var id = $(this).data("id");
                var column_title = $(this).data("column");
                var value = $(this).text();
                update_data(id, column_title, value);
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
                            url: "{{url('/admin/deleteProductCat')}}",
                            method: "POST",
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
        });
    </script>
@endsection
