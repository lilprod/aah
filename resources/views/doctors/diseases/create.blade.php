<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AAH+ - Tropical Diseases</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        
        <!-- Favicons -->
        <link href="{{asset('assets/img/favicon.png') }}" rel="icon">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
        
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">

        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
        
        <!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css') }}">
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css') }}">
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="assets/js/html5shiv.min.js"></script>
            <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    
    </head>
    <body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
    
        <!-- Header -->
            @include('doctors.partials.header')
        <!-- /Header -->

		<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add Disease</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Add Disease <span style="color: #26a9e166">+</span></h2>
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
							<form method="POST" action="{{ route('diseases.store') }}" enctype="multipart/form-data">
        					{{csrf_field()}}
							<!-- Basic Information -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">New Disease and Treatment</h4>
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
												<!--<input type="text" class="form-control" name="description">-->
												<textarea class="form-control" rows="5" name="description" id="article-ckeditor"></textarea>
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
									<h4 class="card-title">Treatement</h4>
									<div class="form-group mb-0">
										<label>Content</label>
										<textarea class="form-control" rows="5" name="treatment" id="article-ckeditor1"></textarea>
									</div>
								</div>
							</div>
							<!-- /About Me -->
							

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
							
							<div class="submit-section submit-btn-bottom">
								<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
							</div>


							</form>
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->

		</div>
      
        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery.min.js') }}"></script>

        <script src="{{ asset('ckeditor/ckeditor.js')}}"></script> 

		<script> CKEDITOR.replace('article-ckeditor'); </script>
		<script> CKEDITOR.replace('article-ckeditor1'); </script>

        <script>
		  $('#title').change(function(e) {
		    $.get('{{ route('disease.check_slug') }}', 
		      { 'title': $(this).val() }, 
		      function( data ) {
		        $('#slug').val(data.slug);
		      }
		    );
		  });
		</script>
        
        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

        <!-- Select2 JS -->
		<script src="{{asset('assets/plugins/select2/js/select2.min.js') }}"></script>
        
        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
        
    </body>
</html>