@extends('admin.layouts.layouts')
@section('title', 'Media and icon')
@section('header-link')
    @parent

@endsection

@section('content')
@parent
<!-- body code  -->
@if(empty($media->id))
<form action="/activeIcon" method="post">
	@csrf

	<button type="submit" name="active" class="active-icon btn update">Active Icons</button>
</form>

@else
<div class="container-fluid">
	<div class="container-social">
		<h5>Manage Social Link</h5>
		<div class="row">
			<!-- facebook  -->
			<div class="col-sm-4">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text"><i class="lni lni-facebook-original"></i></span>
                    <input type="text" data-id="1" data-column="facebook" class="form-control update" value="@if(!empty($media->facebook)){{$media->facebook}}@endif" placeholder="facebook link" name="facebook">

                </div>
			</div>
			<!-- whats_app  -->
			<div class="col-sm-4">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text"><i class="lni lni-whatsapp"></i></span>
                    <input type="text" data-id="1" data-column="whats_app" class="form-control update" value="@if(!empty($media->whats_app)){{$media->whats_app}}@endif" placeholder="whatsapp number" name="whats_app">

                </div>
			</div>
			<!-- Twitter  -->
			<div class="col-sm-4">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text"><i class="lni lni-twitter"></i> </span>
					<input type="text" value="@if(!empty($media->twitter)){{$media->twitter}}@endif" data-id="1" data-column="twitter" name="twitter" class="form-control update" placeholder="twitter link">
				</div>
			</div>
			<!-- instagram  -->
			<div class="col-sm-4">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text"><i class="lni lni-instagram"></i> </span>
					<input type="text" value="@if(!empty($media->instagram)){{$media->instagram}}@endif" data-id="1" data-column="instagram" class="form-control update" placeholder="instagram link" name="instagram">
				</div>
			</div>
			<!-- youtube  -->
			<div class="col-sm-4">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text"><i class="lni lni-youtube"></i> </span>
					<input type="text" value="@if(!empty($media->youtube)){{$media->youtube}}@endif" data-id="1" data-column="youtube" name="youtube" class="form-control update" placeholder="youtube link">
				</div>
			</div>
			<!-- linkedin  -->
			<div class="col-sm-4">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text"><i class="lni lni-linkedin"></i> </span>
					<input type="text" value="@if(!empty($media->linkedin)){{$media->linkedin}}@endif" data-id="1" data-column="linkedin" class="form-control update" placeholder="linkedin link" name="linkedin">
				</div>
			</div>
			<!-- linkedin  -->
			<div class="col-sm-4">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text"><i class="lni lni-pinterest"></i> </span>
					<input type="text" value="@if(!empty($media->pinterest)){{$media->pinterest}}@endif" data-id="1" data-column="pinterest" name="pinterest" class="form-control update" placeholder="pinterest link">
				</div>
			</div>

			<!-- mobileNumber  -->
			<div class="col-sm-4">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text"><i class="lni lni-mobile"></i> </span>
					<input type="text" value="@if(!empty($media->mobileNumber)){{$media->mobileNumber}}@endif" data-id="1" data-column="mobileNumber" name="mobileNumber" class="form-control update" placeholder="xxxx xxxx xx">
				</div>
			</div>

			<!-- emailID  -->
			<div class="col-sm-4">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text"><i class="lni lni-envelope"></i>
						</span>
					<input type="text" value="@if(!empty($media->emailID)){{$media->emailID}}@endif" data-id="1" data-column="emailID" name="emailID" class="form-control update" placeholder="email@domain.com">
				</div>
			</div>
			<!-- Address  -->
			<div class="col-sm-4">
				<div class="forms-inputs mt-2">
					<span>Footer Address</span>
				</div>
				<textarea type="text" rows="8" data-id="1" data-column="address" name="address" class="form-control update" placeholder="address">@if(!empty($media->address)){{$media->address}}@endif</textarea>
			</div>

		</div>
	</div>

	<div class="container-logomanage mt-5">
		<h5>Manage Logo</h5>
		<div class="row">
			<div class="col-sm-4">
				<form id="logoUpload" action="javascript:void(0)" enctype="multipart/form-data" method="POST">
					@csrf
					<!-- id define  -->
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1">Upload Logo</span>
						</div>
						<input type="file" id="logo" name="logo" class="form-control">
					</div>
				</form>
				<div class="input-group mb-3">
					<!-- width  -->
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Width</span>
					</div>
					<input id="width" data-id="1" data-column="width" type="text" class="form-control update width" value="@if(!empty($media->width)){{$media->width}} @else 90px @endif">
				</div>
				<div class="input-group mb-3">
					<!-- height  -->
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">Height</span>
					</div>
					<input id="height" data-id="1" data-column="height" type="text" class="form-control update height" value="@if(!empty($media->height)){{$media->height}} @else auto @endif" aria-label="link" placeholder="auto">
				</div>
			</div>
			<div class="col-sm-8">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<a class="" href="#">

						<div class="d-flex justify-content-center">
							<img id="logoView" class="repLogo" width="@if(!empty($media->width)){{$media->width}}  @endif" height="@if(!empty($media->height)){{$media->height}} @else auto @endif"  src="@if(!empty($media->logo)){{url('assets/images/logo/'.$media->logo)}} @else {{asset('assets/images/web2progress.png')}} @endif" alt="preview logo">
						</div>

					</a>
					<div class="navbar-nav ml-3">
						<a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
						<a class="nav-item nav-link" href="#">Features</a>
						<a class="nav-item nav-link" href="#">Pricing</a>
					</div>
				</nav>
			</div>
		</div>
	</div>
	<p id="altMSG"></p>
</div>
@endif
<!-- body  -->
@endsection
<!--start FOOTER  -->
{{-- FOOTER --}}
@section('footer-script')
@parent
<!--================ End Footer Area =================-->
<script>
	$(document).ready(function() {
		// logonail post
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('#logoUpload').submit(function(e) {
			e.preventDefault();

			var formData = new FormData(this);

			$.ajax({
				type: 'POST',
				url: "{{url('/admin/uloadLogo')}}",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: (data) => {
					this.reset();
					// alert('<span class="text-success alt">' + data + '</span>');
				},
				error: function(data) {
					console.log(data);
				}
			});
		});
		$("#logo").on("change", function() {
			$("#logoUpload").submit();
			// image view
			let reader = new FileReader();
			reader.onload = (e) => {

				$('.repLogo').attr('src', e.target.result);
			}
			reader.readAsDataURL(this.files[0]);
		});
		// update
		// udae data
		function update_data(id, column_title, value) {
			//alert(id+column_title+value);
			$.ajax({
				url: "{{url('/admin/updateIcon')}}",
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

		$(document).on("keyup", '.update', function() {
			var id = $(this).data("id");
			var column_title = $(this).data("column");
			var value = $(this).val();
			update_data(id, column_title, value);
		});
		// width keyup
		$(".repLogo").attr('width', $(".width").val());
		$(".repLogo").attr('height', $(".height").val());
		$(document).on('keyup', '.width', function() {
			$(".repLogo").attr('width', $(".width").val());

		});
		// height keyup
		$(document).on('keyup', '.height', function() {
			$(".repLogo").attr('height', $(".height").val());

		})
	})
</script>
@endsection
