<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - Reviews</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
		
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
									<li class="breadcrumb-item"><a href="{{('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Reviews</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Reviews</h2>
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
							<div class="doc-review review-listing">
							
								<!-- Review Listing -->
								<ul class="comments-list">
								
									<!-- Comment List -->
									<li>
										<div class="comment">
											<img class="avatar rounded-circle" alt="User Image" src="{{asset('assets/img/patients/patient.jpg') }}">
											<div class="comment-body">
												<div class="meta-data">
													<span class="comment-author">Richard Wilson</span>
													<span class="comment-date">Reviewed 2 Days ago</span>
													<div class="review-count rating">
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star"></i>
													</div>
												</div>
												<p class="recommended"><i class="far fa-thumbs-up"></i> I recommend the doctor</p>
												<p class="comment-content">
													Lorem ipsum dolor sit amet, consectetur adipisicing elit,
													sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
													Ut enim ad minim veniam, quis nostrud exercitation.
													Curabitur non nulla sit amet nisl tempus
												</p>
												<div class="comment-reply">
													<a class="comment-btn" href="#">
														<i class="fas fa-reply"></i> Reply
													</a>
												   <p class="recommend-btn">
													<span>Recommend?</span>
													<a href="#" class="like-btn">
														<i class="far fa-thumbs-up"></i> Yes
													</a>
													<a href="#" class="dislike-btn">
														<i class="far fa-thumbs-down"></i> No
													</a>
												</p>
												</div>
											</div>
										</div>
										
										<!-- Comment Reply -->
										<ul class="comments-reply">
										
											<!-- Comment Reply List -->
											<li>
												<div class="comment">
													<img class="avatar rounded-circle" alt="User Image" src="{{asset('assets/img/doctors/doctor-thumb-02.jpg') }}">
													<div class="comment-body">
														<div class="meta-data">
															<span class="comment-author">Dr. Darren Elder</span>
															<span class="comment-date">Reviewed 3 Days ago</span>
														</div>
														<p class="comment-content">
															Lorem ipsum dolor sit amet, consectetur adipisicing elit,
															sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
															Ut enim ad minim veniam.
															Curabitur non nulla sit amet nisl tempus
														</p>
														<div class="comment-reply">
															<a class="comment-btn" href="#">
																<i class="fas fa-reply"></i> Reply
															</a>
														</div>
													</div>
												</div>
											</li>
											<!-- /Comment Reply List -->
											
										</ul>
										<!-- /Comment Reply -->
										
									</li>
									<!-- /Comment List -->
									
									<!-- Comment List -->
									<li>
										<div class="comment">
											<img class="avatar rounded-circle" alt="User Image" src="{{asset('assets/img/patients/patient2.jpg') }}">
											<div class="comment-body">
												<div class="meta-data">
													<span class="comment-author">Travis Trimble</span>
													<span class="comment-date">Reviewed 4 Days ago</span>
													<div class="review-count rating">
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
													</div>
												</div>
												<p class="comment-content">
													Lorem ipsum dolor sit amet, consectetur adipisicing elit,
													sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
													Ut enim ad minim veniam, quis nostrud exercitation.
													Curabitur non nulla sit amet nisl tempus
												</p>
												<div class="comment-reply">
													<a class="comment-btn" href="#">
														<i class="fas fa-reply"></i> Reply
													</a>
													<p class="recommend-btn">
														<span>Recommend?</span>
														<a href="#" class="like-btn">
															<i class="far fa-thumbs-up"></i> Yes
														</a>
														<a href="#" class="dislike-btn">
															<i class="far fa-thumbs-down"></i> No
														</a>
													</p>
												</div>
											</div>
										</div>
									</li>
									<!-- /Comment List -->
									
								</ul>
								<!-- /Comment List -->
								
							</div>
						</div>
					</div>
				</div>

			</div>		
			<!-- /Page Content -->
   
			<!-- Footer -->
				@include('website.footer')
			<!-- /Footer -->
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>