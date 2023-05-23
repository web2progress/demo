@section('footer-script')
<!-- Bootstrap JS -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>

<script src="{{asset('assets/plugins/jquery-knob/excanvas.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
  <script>
      $(function() {
          $(".knob").knob();
      });
  </script>

<!--app JS-->
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.cacheClear', function() {
            var id = 'clear';
            swal({
                title: "Are you sure?",
                text: "Cache Clear",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Move it!",
                closeOnConfirm: false
            }).then(isConfirmed => {
                if (isConfirmed) {

                    $.ajax({
                        url: "{{url('/admin/clear-cache-all')}}",
                        method: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id
                        },
                        success: function(data) {
                            // show allert
                            swal("Clear!", "'" + data + "'", "success");
                        }
                    });
                };
            });
        });
    });
</script>
@show
