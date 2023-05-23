 <div class="row gallery">
     @foreach($galleries as $gallery)
     <div id="del{{$gallery->id}}" class="col-sm-2 mt-4">
         <div class="galleryAlbum">
             <span class="btn btn-sm btn-danger text-light delete" id="{{$gallery->id}}"><i class="lni lni-trash"></i></span>
             <a href="{{asset('/admin/images/gallery/')}}/{{$gallery->imag_title}}" data-lightbox="roadtrip">
                 <img class="img-fluid" src="{{asset('images/gallery/')}}/{{$gallery->imag_title}}" alt="" title="">
             </a>
         </div>
     </div>
     @endforeach
 </div>
 <script>
     $(document).ready(function() {
         // delete
         $(function() {
             $(".delete").click(function() {
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
                             url: "{{url('/admin/deleteGallery')}}",
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
                         $("#del" + id).animate({
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
     });
 </script>
