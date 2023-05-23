<div class="row">
    @foreach ($slider as $sliderIMG)
        <div id="del{{ $sliderIMG->id }}" class="col-sm-4 mt-2">
            <div class="galleryAlbum">
                <span class="btn btn-sm btn-danger text-light delete" id="{{ $sliderIMG->id }}"><i
                        class="lni lni-trash"></i></span>
                <a href="{{ asset('images/slider/') }}/{{ $sliderIMG->image }}" data-lightbox="roadtrip">
                    <img class="img-fluid" src="{{ asset('images/slider/') }}/{{ $sliderIMG->image }}" alt=""
                        title="">
                </a>
                <div class="activeSlide" id="{{ $sliderIMG->id }}">
                    @if ($sliderIMG->position == 1)
                        Activated
                    @else
                        De-Activate
                    @endif
                </div>
            </div>
            <div class="slider-text">
                <input type="text" class="form-control update" data-column="heading_txt" data-id="{{ $sliderIMG->id }}" placeholder="Heading Text" value="{{ $sliderIMG->heading_txt }}">
                <input type="text" class="form-control update" data-column="paragraf_txt" data-id="{{ $sliderIMG->id }}" placeholder="Paragraf Text" value="{{ $sliderIMG->paragraf_txt }}">
                <input type="text" class="form-control update" data-column="slug" data-id="{{ $sliderIMG->id }}" placeholder="URL" value="{{ $sliderIMG->slug }}">
                <input type="text" class="form-control update" data-column="btn_txt" data-id="{{ $sliderIMG->id }}" placeholder="Button Text" value="{{ $sliderIMG->btn_txt }}">
                <select class="form-control update" data-column="style_type" data-id="{{ $sliderIMG->id }}">
                    <option value="">--select style--</option>
                    <option value="1" {{$sliderIMG->style_type == '1' ? 'selected':''}}>Style 1</option>
                    <option value="2" {{$sliderIMG->style_type == '2' ? 'selected':''}}>Style 2</option>
                    <option value="3" {{$sliderIMG->style_type == '3' ? 'selected':''}}>Style 3</option>
                </select>
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
                            url: "{{ url('/admin/deleteSlider') }}",
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


        // activeSlide
        $(function() {
            $(".activeSlide").click(function() {
                var id = $(this).attr("id");
                swal({
                    title: "Are you sure?",
                    text: "Active Now!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{ url('/admin/activeSlide') }}",
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
                                // call load slider
                                $('#slider').load(
                                    "{{ route('manage-slider.create') }}"
                                );
                            }
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });

            });
        });


        $(function() {
            $(document).on('change','.update', function() {
                var id = $(this).data('id');
                var column = $(this).data('column');
                var value = $(this).val();

                $.ajax({
                    method:'post',
                    url:"{{ url('/admin/slider-text-update') }}",
                    data:{
                        '_token':"{{csrf_token()}}",
                        id:id,
                        column:column,
                        value:value
                    },
                    success:function(response){
                        if(response.status==true){

                        }else{

                        }
                    }


                })
            })
        })
    });
</script>
