@extends('admin.layouts.layouts')
@section('title', 'Edit' . $editmodal->title)
@section('header-link')
    @parent
    <!-- custom link  -->
    <link rel="stylesheet" href="{{ asset('frontend/switch/css/bootstrap-switch-button.min.css') }}">
    <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>
    <link rel="stylesheet" href="{{ asset('vendor/laraberg/css/laraberg.css') }}">

    <style>
        .wp-block {
            max-width: 100% !important;
        }
        .laraberg__editor {
            z-index: 9;
        }
    </style>
@endsection
@section('content')
    @parent
    <!-- body code  -->
    {{-- message --}}
    <div id="messageAlt"></div>
    <div class="container-fluid product-ourt">
        <div class="row ">
            <div class="col-sm-12">
                <div class="d-flex justify-content-between">
                    <!--    title-->
                    <div class="forms-inputs col-md-6"> <span>Title*</span>
                        <input type="text" id="title" class="form-control update" value="{{ $editmodal->title }}"
                            autocomplete="off" required>
                        <div class="invalid-feedback">
                            Enter Title
                        </div>
                        <p class="text-danger ">{{ $errors->first('title') }}
                        <p>
                    </div>
                    <div class="d-flex align-items-center pt-2">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" data-id="{{ $editmodal->id }}" data-column="status" value="draft"
                                class="btn btn-primary clickUpdate">Draft</button>
                            <button type="button" data-id="{{ $editmodal->id }}" data-column="status" value="publish"
                                class="btn btn-success clickUpdate">publish</button>
                        </div>
                    </div>
                </div>
                <textarea id="Modelcontent" class="form-control update" placeholder="Design your modal..">{{ $editmodal->content }}</textarea>


            </div>
        </div>
    </div>

    <!--end body code  -->
@endsection
<!--start FOOTER  -->
@section('footer-script')
    @parent

    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('.sidebar-mini').addClass('sidebar-collapse');

        Laraberg.init('Modelcontent', {
            height: '600px',
            sidebar: false,
            setting: false,
            laravelFilemanager: true,
            laravelFilemanager: true
        });



        $(document).ready(function() {
            // post_update
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click", '.clickUpdate', function() {
                var title = $('#title').val();
                var status = $(this).val();
                var id = $(this).data("id");
                var content = Laraberg.getContent();
               // console.log(content);
                $.ajax({
                    url: "{{ route('blog-modals.update', $editmodal->id) }}",
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id,
                        title: title,
                        content: content,
                        status: status
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
            });

        });
    </script>
@endsection
