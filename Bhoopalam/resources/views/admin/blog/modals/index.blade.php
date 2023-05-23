@extends('admin.layouts.layouts')
@section('title', 'Modals')
@section('header-link')
    @parent
    <!-- custom link  -->
    <link rel="stylesheet" href="{{ asset('frontend/switch/css/bootstrap-switch-button.min.css') }}">
    <!-- custom link  -->
    <link rel="stylesheet" href="{{ asset('frontend/switch/css/bootstrap-switch-button.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/laraberg/css/laraberg.css') }}">
@endsection
@section('content')
    @parent
    <!-- body code  -->
    <div class="container-fluid product-ourt pt-4">
        <!-- create tag  -->
        <!-- error alert  -->
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @endif

        <!-- success alert  -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif





        <div id="createPopUp" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Add title and continue</h5>
                        <button class="btn close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('blog-modals.store') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="forms-inputs w-100"> <span>Model Title*</span>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title') }}" autocomplete="off" required>
                                <div class="invalid-feedback">
                                    Enter Model Title
                                </div>
                                <p class="text-danger p-2">{{ $errors->first('title') }}
                                <p>
                                <div class="mb-3"> <button v-on:click.stop.prevent="submit"
                                        class="btn btn-dark w-100">Create</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!--end create tag  -->
        <!-- DataTales  -->
        <div class="d-flex py-3 justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Modals </h6>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createPopUp"
                type="button">Create
                Modal</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tile</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Tile</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($modals as $modal)
                        <tr>
                            <td>{{ $modal->title }}</td>
                            <td>{{ $modal->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group btn-sm">
                                    <button class="btn btn-info" type="button" data-bs-toggle="modal"
                                        data-bs-target="#createPopUp{{ $modal->id }}">View</button>
                                    <a href="{{ url('admin/blog-modals/' . $modal->id . '/edit') }}"
                                        class="btn btn-sm btn-success"><i class="lni lni-pencil"></i></a>
                                    <button data-route="{{ route('blog-modals.destroy', $modal->id) }}" type="button"
                                        class="btn btn-sm btn-danger text-light delete" id="{{ $modal->id }}"><i
                                            class="lni lni-trash"></i></button>


                                    {{-- model --}}
                                    <div id="createPopUp{{ $modal->id }}" class="modal fade" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="my-modal-title">{{ $modal->title }}</h5>
                                                    <button class="btn close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-wrap w-100" >
                                                    <div class="clearfix"></div>
                                                    {!! $modal->content !!}
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <!-- {!! $modals->links() !!} -->
                {!! $modals->appends(['sort' => 'department'])->links() !!}
            </div>
        </div>

    </div>
    <!--end body code  -->
@endsection
<!--start FOOTER  -->
{{-- FOOTER --}}
@section('footer-script')
    @parent
    <script>
        $(document).ready(function() {
            // delete
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#dataTable").on("click", ".delete", function() {
                var id = $(this).attr("id");
                var route = $(this).data("route");

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            type: 'DELETE',
                            url: route,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: id
                            },
                            success: function(response) {
                                if (response.status == true) {
                                    Lobibox.notify('success', {
                                        pauseDelayOnHover: true,
                                        continueDelayOnInactiveTab: false,
                                        position: 'top right',
                                        icon: 'bx bx-check-circle',
                                        msg: response.msg
                                    });
                                } else {
                                    Lobibox.notify('error', {
                                        pauseDelayOnHover: true,
                                        continueDelayOnInactiveTab: false,
                                        position: 'top right',
                                        icon: 'bx bx-check-circle',
                                        msg: response.msg
                                    });
                                }

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
