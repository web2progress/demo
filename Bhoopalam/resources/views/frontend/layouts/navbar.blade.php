@section('navbar')
    <header>

        <div class="container-fluid px-0" style="color: green">

            <div class="topheader d-none d-sm-block">
                <div class="container">
                    <div class="row p-1">

                        <div class="col-sm-2 border-end">

                            <div class="d-flex align-items-center ">
                                <div class="contact-icon">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div class="contact-det">
                                    <h5 class="mb-0 pb-0">
                                        {{ $media->mobileNumber }}</h5>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-4 ">
                            @if (!empty($media->emailID))
                                <div class="d-flex align-items-center ms-2">
                                    <div class="contact-icon">
                                        <i class="fa-regular fa-envelope"></i>
                                    </div>
                                    <div class="contact-det">
                                        <h5 class="mb-0"> {{ $media->emailID }} </h5>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-sm-6 ">
                            <div class="social-icon d-flex justify-content-end">
                                <a href="{{ $media->facebook }}"><i class="fa-brands fa-facebook-f mr-2"></i></a></li>
                                <a href="{{ $media->instagram }}"><i class="fa-brands fa-instagram mr-2"></i></a></li>
                                <a href="{{ $media->facebook }}"><i class="fa-brands fa-linkedin-in mr-2"></i></a></li>
                                <a href="{{ $media->twitter }}"><i class="fa-brands fa-twitter mr-2"></i></a></li>
                                <a href="{{ $media->twitter }}"><i class="fa-brands fa-whatsapp"></i></a></li>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <nav id="myHeader" class="navbar navbar-expand-lg py-lg-0 navbar-light sticky-top start-header shadow">
                <div class="container pl-0 px-0">
                    <a class="navbar-brand" href="{{ url('') }}">
                        @if (!empty($media->logo))
                            <img width="@if (!empty($media->width)) {{ $media->width }} @endif"
                                height="@if (!empty($media->height)) {{ $media->height }} @else auto @endif"
                                id="logoView" src="{{ url('assets/images/logo/' . $media->logo) }}" alt="preview logo">
                        @else
                            {{ config('app.name', 'PVR') }}
                        @endif
                    </a>
                    <a type="button"
                        class="btn me-lg-4 border-0  text-decoration-none d-md-none d-block mb-connection btn-anim"
                        data-bs-toggle="modal" data-bs-target="#exampleModal3">
                        <span></span><span></span>Get Connection<span></span> <span></span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                        <ul class="navbar-nav text-center ms-lg-3">
                            @if (!empty($topNavItems))
                                @foreach ($topNavItems as $nav)
                                    @if (!empty($nav->children[0]))
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                @if ($nav->name == null)
                                                    {!! $nav->title !!}
                                                @else
                                                    {!! $nav->name !!}
                                                @endif
                                            </a>

                                            <ul class="dropdown-menu">

                                                @foreach ($nav->children[0] as $childNav)
                                                    @if (empty($childNav->children[0]))
                                                        @if ($childNav->type == 'custom')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('') }}{{ $childNav->slug }}">
                                                                    @if ($childNav->name == null)
                                                                        {!! $childNav->title !!}
                                                                    @else
                                                                        {!! $childNav->name !!}
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        @elseif($childNav->type == 'category')
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('') }}{{ $childNav->slug }}">
                                                                    @if ($childNav->name == null)
                                                                        {!! $childNav->title !!}
                                                                    @else
                                                                        {!! $childNav->name !!}
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ url('') }}{{ $childNav->slug }}">

                                                                    @if ($childNav->name == null)
                                                                        {!! $childNav->title !!}
                                                                    @else
                                                                        {!! $childNav->name !!}
                                                                    @endif
                                                                </a>
                                                            </li>
                                                        @endif
                                                    @endif


                                                    @if (!empty($childNav->children[0]))
                                                        <li class="dropdown-submenu">
                                                            <a class="test dropdown-item" href="#" role="button"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                @if ($childNav->name == null)
                                                                    {!! $childNav->title !!}
                                                                @else
                                                                    {!! $childNav->name !!}
                                                                @endif
                                                                <span class="caret"><i class="fa fa-caret-right ms-2"
                                                                        aria-hidden="true"></i></span>
                                                            </a>
                                                            <ul class="dropdown-menu pt-0">
                                                                <li>
                                                                    @foreach ($childNav->children[0] as $secName)
                                                                        @if ($secName->type == 'custom')
                                                                            <a class="dropdown-item"
                                                                                href="{{ url('') }}{{ $secName->slug }}">
                                                                                @if ($secName->name == null)
                                                                                    {!! $secName->title !!}
                                                                                @else
                                                                                    {{ $secName->name }}
                                                                                @endif
                                                                            </a>
                                                                        @elseif($secName->type == 'category')
                                                                            <a class="dropdown-item"
                                                                                href="{{ url('') }}{{ $secName->slug }}">
                                                                                @if ($secName->name == null)
                                                                                    {!! $secName->title !!}
                                                                                @else
                                                                                    {!! $secName->name !!}
                                                                                @endif
                                                                            </a>
                                                                        @else
                                                                            <a class="dropdown-item"
                                                                                href="{{ url('') }}{{ $secName->slug }}">
                                                                                @if ($secName->name == null)
                                                                                    {!! $secName->title !!}
                                                                                @else
                                                                                    {!! $secName->name !!}
                                                                                @endif
                                                                            </a>
                                                                        @endif
                                                                    @endforeach
                                                                </li>

                                                            </ul>
                                                        </li>
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </li>
                                    @else
                                        @if ($nav->type == 'custom')
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('') }}{{ $nav->slug }}">
                                                    @if ($nav->name == null)
                                                        {!! $nav->title !!}
                                                    @else
                                                        {!! $nav->name !!}
                                                    @endif
                                                </a>
                                            </li>
                                        @elseif($nav->type == 'category')
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('') }}{{ $nav->slug }}">
                                                    @if ($nav->name == null)
                                                        {!! $nav->title !!}
                                                    @else
                                                        {!! $nav->name !!}
                                                    @endif
                                                </a>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url('') }}{{ $nav->slug }}">
                                                    @if ($nav->name == null)
                                                        {!! $nav->title !!}
                                                    @else
                                                        {!! $nav->name !!}
                                                    @endif
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                            @endif



                        </ul>
                        <div class="d-flex justify-content-end ">
                            <a type="button" class="btn me-lg-4 border-0  d-none d-sm-block text-decoration-none  btn-anim"
                                data-bs-toggle="modal" data-bs-target="#exampleModal3">
                                <span></span><span></span>Get Connection<span></span> <span></span>
                            </a>
                            <a href="{{ url('userlogin') }}" class="mb-log-btn"> <i class="fa fa-user login-btn"
                                    aria-hidden="true"></i></a>
                        </div>

                    </div>
                </div>
            </nav>

            {{-- model start here --}}

            <form id="CustomerAdd" action="javascript:void(0)" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Please fill this form to get Plan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-5 d-none d-sm-block ">
                                        <div class="form-left-img  ">
                                            <img src="{{ asset('frontend/images/banner 1.jpg') }}" width="100%" >
                                        </div>
                                    </div>

                                    <div class="col-sm-7 ps-lg-0">
                                        <div class="row">
                                            <div class="col-6 pe-1">
                                                <div class="mb-2">
                                                    <label for="exampleFormControlInput1" class="form-label">Name</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" placeholder="Enter Name"
                                                        name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-6 ps-1">
                                                <div class="mb-2">
                                                    <label for="exampleFormControlInput1" class="form-label">Mobile
                                                        Number</label>
                                                    <input type="number" class="form-control" id="number"
                                                        placeholder="Enter Mobile" max="9999999999" min="6666666666"
                                                        name="mobile" onkeyup="NumberCheck(this.value)"
                                                        onkeydown="NumberCheck(this.value)" required>
                                                    <small class="small d-none" style="color:red">This number already
                                                        excits please try
                                                        different number to get the plan</small>
                                                </div>
                                            </div>
                                            <div class="col-6 pe-1">
                                                <div class="mb-2">
                                                    <label for="exampleFormControlInput1" class="form-label">Email
                                                        address</label>
                                                    <input type="email" class="form-control"
                                                        id="exampleFormControlInput1" placeholder="Enter Email"
                                                        name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-6 ps-1">
                                                <div class="mb-2">
                                                    <label for="exampleFormControlInput1" class="form-label">Plan
                                                        Name</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleFormControlInput1" placeholder="Enter Email"
                                                        name="planname" value="No Plan Selected" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <label for="exampleFormControlInput1" class="form-label">Aadhar Card</label>
                                            <input type="file" class="form-control" id="exampleFormControlInput1"
                                                name="aadhar" required>
                                        </div>
                                        <div class="mb-2">
                                            <label for="exampleFormControlInput1" class="form-label">Pan Card</label>
                                            <input type="file" class="form-control" id="exampleFormControlInput1"
                                                name="pan" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">message</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remark"></textarea>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-success subbtn">Submit</button>
                                        </div>


                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </header>




    <!-----------active class script----------------->



    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#CustomerAdd').submit(function(e) {
            e.preventDefault(e);
            $('#exampleModal').modal('hide').data('bs.modal', null);


            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: "{{ url('/CustomerAdd') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    this.reset();
                    alert('you get this plan  successfully');
                },
                error: function(data) {
                    alert('some error occured to get plan');
                    console.log(data);
                }
            });
        });



        function NumberCheck(value) {

            $.ajax({
                type: "get",
                url: "number_exists/" + value,
                dataType: "json",
                success: function(msg) {
                    if (msg.msg == 'success') {
                        $('.small').removeClass('d-none');
                        $('.subbtn').addClass('d-none');
                    } else {
                        $('.small').addClass('d-none');
                        $('.subbtn').removeClass('d-none');
                    }
                }
            });

        }
    </script>
@show
