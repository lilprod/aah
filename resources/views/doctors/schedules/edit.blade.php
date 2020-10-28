@extends('doctors.layouts.app')

@section('content')

<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Post</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Edit Post</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->

			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						@include('doctors.partials.profile_side')

						<div class="col-md-7 col-lg-8 col-xl-9">
							<form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
				            {{ csrf_field() }}
				            {{ method_field('PATCH') }}
							<!-- Basic Information -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Edit Post : {{$post->title}} </h4>
									<div class="row form-row">
										
										<div class="col-md-6">
											<div class="form-group">
												 <label>Title <span class="text-danger">*</span></label>
                								<input class="form-control" type="text" name="title" id="title" value="{{$post->title}}">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">

												<label>Slug <span class="text-danger">*</span></label>
                								<input class="form-control" type="text" name="slug" id="slug" value="{{$post->slug}}">

											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label>Extract</label>
												<input type="text" class="form-control" name="description" value="{{$post->description}}">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Video URL</label>
												<input type="text" class="form-control" name="video_url" value="{{$post->video_url}}">
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label>Category</label>
												<select class="form-control select" name="category_id">
													@foreach($categories as $category)
														<option value="{{$category->id}}"  {{ ($post->category_id === $category->id) ? 'selected' : '' }}">{{$category->title}}</option>.
													@endforeach
												</select>
											</div>
										</div>

									</div>
								</div>
							</div>
							<!-- /Basic Information -->
							
							<div class="col-md-12">
								<div class="form-group">
									<div class="change-avatar">
										<!--<div class="profile-img">
											<img src="{{asset('assets/img/doctors/doctor-thumb-02.jpg') }}" alt="User Image">
										</div>-->
										<div class="upload-img">
											<div class="change-photo-btn">
												<span><i class="fa fa-upload"></i> Upload Image</span>
												<input type="file" class="upload" name="cover_image">
											</div>
											<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
										</div>
									</div>
								</div>
							</div>
							<!-- About Me -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Post Body</h4>
									<div class="form-group mb-0">
										<label>Content</label>
										<textarea class="form-control" rows="5" name="body" id="article-ckeditor">{{$post->body}}</textarea>
									</div>
								</div>
							</div>
							<!-- /About Me -->

							<div class="form-group">
				                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="blog_active" value="1" {{  $post->status == 1 ? 'checked' : '' }}>
									<label class="form-check-label" for="blog_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="blog_inactive" value="0" {{  $post->status == 0 ? 'checked' : '' }}>
									<label class="form-check-label" for="blog_inactive">
									Inactive
									</label>
								</div>
				            </div>
							
							<div class="submit-section submit-btn-bottom">
								<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
							</div>

						 </form>
						</div>
					</div>
				</div>
			</div>		
			<!-- /Page Content -->
@endsection

@push('slug')
<script>
  $('#title').change(function(e) {
    $.get('{{ route('post.check_slug') }}', 
      { 'title': $(this).val() }, 
      function( data ) {
        $('#slug').val(data.slug);
      }
    );
  });
</script>
@endpush