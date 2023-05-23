@extends('admin.layouts.layouts')
@section('title', 'Dashboard')
@section('header-link')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- custom link --}}
@endsection

@section('content')

    <?php
        $Enquiry=  App\Models\ StoreEnquiry::orderBy('id', 'DESC')->get();
        $sn=1;
    ?>














    <div class="container">
        <div class="row p-4">
            <table class="table me-4">
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($Enquiry as $Enquiry)
                        <tr>
                            <td>  {{$sn}}</td>
                            <td>{{ $Enquiry->name }}</td>
                            <td>{{ $Enquiry->email }}</td>
                            <td>{{ $Enquiry->phone }}</td>
                            <td>{{ $Enquiry->subject }}</td>
                            <td>{{ $Enquiry->message }}</td>
                            <td> <span><a  href="#"><i
                                    class="fa-sharp fa-solid fa-trash deleteData"  data-id="{{ $Enquiry->id }}"></i></a></span></td>


                        </tr>
<?php   $sn++;  ?>


                    @endforeach
                </tbody>
            </table>
        </div>

    @endsection

    {{-- <div class="paginate  m-2">
        {{$Enquiry->links()}}
        </div> --}}

    @section('footer-script')
        @parent
        <script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('assets/js/index.js') }}"></script>


        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#dataForm').submit(function(e) {
                e.preventDefault();
                $('#exampleModal').modal('toggle');
                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('plans.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        this.reset();
                        alert('data  saved successfully')
                    },
                    error: function(data) {
                        console.log(data);
                        alert('some error occured')

                    }
                });
            });
            $("#thumb").on("change", function() {
                $("#productImageUpload").submit();
                // image view
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#image_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });




//   delete items from here


$('body').on('click', '.deleteData', function() {

                var id = $(this).data("id");
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {

                    if (willDelete) {

                        $.ajax({
                            type: "get",
                            url: "{{ url('delete-enquiry') }}" + '/' + id,
                            success: function(response) {
                                alert('success');
                                table.draw();
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

                            },
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
