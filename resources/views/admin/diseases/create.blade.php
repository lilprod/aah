@extends('admin.layouts.app')

@section('content')

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-title">Add Disease</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="javascript:(0);">Diseases</a></li>
					<li class="breadcrumb-item active">Add Disease</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->

	<div class="row">
	    <div class="col-md-12">
			@include('inc.messages')
		</div>
	</div>


				<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body custom-edit-service">
							
							<div class="row mb-5">
                            <div class="col">
                                <ul class="nav nav-tabs nav-tabs-solid">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('admin.diseases')}}">Disaeses</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary btn-sm" href="{{route('admin_diseases_create')}}"><i class="fas fa-plus mr-1"></i> Add Disease</a>
                            </div>
                        </div>
					
						<!-- Add Blog -->
						<form method="POST" enctype="multipart/form-data" autocomplete="off" id="update_service" action="{{ route('admin_posts_store') }}">
							{{csrf_field()}}

							<div class="row form-row">
										
										<div class="col-md-6">
											<div class="form-group">
												 <label>Title <span class="text-danger">*</span></label>
                								<input class="form-control" type="text" name="title" id="title">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												 <label>Scientific Name <span class="text-danger">*</span></label>
                								<input class="form-control" type="text" name="scientific_name" value="">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">

												<label>Slug <span class="text-danger">*</span></label>
                								<input class="form-control" type="text" name="slug" id="slug">

											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Video URL</label>
												<input type="text" class="form-control" name="video_url">
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label>Description</label>
												<textarea class="form-control" rows="5" name="description" id="article-ckeditor"></textarea>
											</div>
										</div>


									</div>

							<!-- /Basic Information -->
							
							<div class="service-fields mb-3">
								<div class="row">
									<div class="col-lg-12">
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
								</div>
							</div>
									
								

							<div class="service-fields mb-3">
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label>Treatement <span class="text-danger">*</span></label>
											<textarea id="article-ckeditor1" class="form-control service-desc" name="treatment"></textarea>
										</div>
									</div>
								</div>
							</div>
							

							<div class="form-group">
				                <label class="display-block">Status</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="blog_active" value="1" checked>
									<label class="form-check-label" for="blog_active">
									Active
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="status" id="blog_inactive" value="0">
									<label class="form-check-label" for="blog_inactive">
									Inactive
									</label>
								</div>
				            </div>


							<div class="submit-section">
								<button class="btn btn-primary submit-btn" type="submit" name="form_submit" value="submit">Submit</button>
							</div>

						</form>
						<!-- /Add Blog -->


						</div>
					</div>
				</div>			
			</div>

@endsection

@push('add_disease')
<script>
  $('#title').change(function(e) {
    $.get('{{ route('admin.disease.check_slug') }}', 
      { 'title': $(this).val() }, 
      function( data ) {
        $('#slug').val(data.slug);
      }
    );
  });
</script>
@endpush