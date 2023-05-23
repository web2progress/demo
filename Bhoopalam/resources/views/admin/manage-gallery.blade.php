@extends('admin.layouts.layouts')
@section('title', 'Manage Galley')
@section('header-link')
@parent
<!-- Custom styles for this page -->
<link href="{{asset('admin-assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection
@section('content')
@parent
<!-- body code  -->
<div class="container-fluid  product-ourt pt-4">
     <!-- create album  -->
     <!-- success alert  -->
     @if (session('success'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
          </button>
     </div>
     @endif
     <div class="p-2">
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
                         @foreach($albums as $album)
                         <tr>
                              <td contenteditable="true" class="update" data-id="{{$album->id}}" data-column="album_title">{{$album->album_title}}
                              </td>
                              <td>
                                <!-- count image  -->
                                &LeftAngleBracket;
                                {{ App\Models\Gallery::where('album_id', $album->id)->count() }}
                                &RightAngleBracket;
                            </td>
                              <td contenteditable="true" class="update" data-id="{{$album->id}}" data-column="album_slug">{{$album->album_slug}}</td>
                              <td>{{$album->created_at->format('d/m/Y')}}</td>
                              <td>
                                   <div class="d-flex justify-content-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                             <a href="/admin/add-images/{{$album->id}}" class="btn btn-secondary">Add image</a>
                                             <button type="button" class="btn btn-sm btn-danger text-light delete" id="{{$album->id}}"><i class="lni lni-trash"></i>
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
<!-- <script src="{{asset('admin-assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin-assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script> -->
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
            text = text.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase()//replace all special characters | symbols with a space
            .replace(/^\s+|\s+$/gm,'')// trim spaces at start and end of string
            .replace(/\s+/g, '-');// replace space with dash/hyphen
               $('#album_slug').val(text);
          });
          // udae data
          function update_data(id, column_title, value) {
               // alert(id+column_title+value);
               $.ajax({
                    url: "/updateAlbum",
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
                              url: "{{url('/deleteAlbum')}}",
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
