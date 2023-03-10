@extends('layouts.app')
@section('title', 'Dashboard - Create Product')
@section('content')
<div class="content container-fluid">

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col">
				<h3 class="page-title">Create Product</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Create Product</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Product Details</h4>
				</div>
				<div class="card-body">
					@foreach($errors->all() as $error)
					{{$error}}
					@endforeach
					<form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Product Name</label>
									<input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
									@if($errors->has('name'))
			                            @foreach($errors->get('name') as $message)
			                              <span style="color:red">{{$message}}</span>
			                            @endforeach
			                         @endif
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-6">	
										<div class="form-group">
											<label>Price</label>
											<input type="text" value="{{ old('price') }}" id="price" name="price" class="form-control product_prices" required>
											@if($errors->has('price'))
					                            @foreach($errors->get('price') as $message)
					                              <span style="color:red">{{$message}}</span>
					                            @endforeach
					                        @endif
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Old Price</label>
											<input type="text" value="{{ old('old_price') }}" id="old_price" name="old_price" class="form-control product_prices">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Product Category</label>
									<select class="form-control @error('category') is-invalid @enderror" id="category" data-route="{{url('get_more_product_details')}}" name="category" required>
										<option value="">Choose Category</option>
										@foreach(App\Category::all() as $category)
											<option value="{{$category->id}}">{{ucwords($category->title)}}</option>
										@endforeach
									</select>
									@if($errors->has('category'))
			                            @foreach($errors->get('category') as $message)
			                              <span style="color:red">{{$message}}</span>
			                            @endforeach
			                         @endif
								</div>
							</div>
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label>Percent Off</label>
											<input type="text" value="{{ old('percent_off') }}" id="percent_off" name="percent_off" class="form-control">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Stock</label>
											<input type="number" name="stock" min="1" class="form-control" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Is Product New?</label>
											<select class="form-control" name="is_new">
												<option value="0" {{ (old("is_new") == 0 ? "selected":"") }}>No</option>
												<option value="1" {{ (old("is_new") == 1 ? "selected":"") }}>Yes</option>
											</select>
											@if($errors->has('is_new'))
					                            @foreach($errors->get('is_new') as $message)
					                              <span style="color:red">{{$message}}</span>
					                            @endforeach
					                        @endif
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="row" id="more_details" style="display: none;"></div>
							</div>
							<div class="col-md-12">
								<div class="input-images"></div>
								<br>
								@if($errors->has('images'))
		                            @foreach($errors->get('images') as $message)
		                              <span style="color:red">{{$message}}</span>
		                            @endforeach
		                        @endif
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Video Link</label>
									<input type="text" id="video_link" name="video_link" value="{{ old('video_link') }}" class="form-control">
								</div>
							</div>
							<div class="col-md-12">
								@if($errors->has('description'))
		                            @foreach($errors->get('description') as $message)
		                              <span style="color:red">{{$message}}</span>
		                            @endforeach
		                        @endif
								<textarea rows="8" name="description" class="form-control summernote @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
							</div>
						</div>
						<div class="text-right">
							<button type="submit" class="btn btn-lg btn-success bs_dashboard_btn bs_btn_color">UPLOAD</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
$(document).ready(function () {
	$(document).on('change','#category',function(){
		var cat_id = $(this).val();
		var route = $(this).attr('data-route');
		if (cat_id != '') {
			$.ajax({
				url:route,
				method:'POST',
				data:{id:cat_id,'_token':'<?=csrf_token()?>'},
				success:function(data){
					$("#more_details").html(data.html);
					$("#more_details").slideDown('slow');
					$('#_tags').select2({
						tags:true,
					});
					$('#_sizes').select2();
					$('#_colors').select2();
					$('#_subcategories').select2();
				}
			});
		}else{
			$("#more_details").slideUp('slow')
			$("#more_details").empty();
		}
	});
	$('.input-images').imageUploader({Default: ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml']});
})
</script>
@endsection