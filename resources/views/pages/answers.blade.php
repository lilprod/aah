<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>AAH+ - Result(s)</title>
		
		<!-- Favicons -->
		<link type="image/x-icon" href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">

		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css') }}">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css') }}">
		
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fancybox/jquery.fancybox.min.css') }}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css') }}">

		<link href="{{asset('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
			
		@include('website.hearder')

		<!-- Breadcrumb -->
			<!--<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-8 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Search</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">{{$nb}} match(es) found  for your query</h2>
						</div>

						<div class="col-md-4 col-12 d-md-block d-none">
							<div class="sort-by">
								<span class="sort-title">Sort by</span>
								<span class="sortby-fliter">
									<select class="select">
										<option>Select</option>
										<option class="sorting">Rating</option>
										<option class="sorting">Popular</option>
										<option class="sorting">Latest</option>
										<option class="sorting">Free</option>
									</select>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>-->
			<!-- /Breadcrumb -->

			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
		            	<div class="col-md-12 col-lg-12">
							<div class="row align-items-center mb-4">
								<div class="col-md-6 col">
									<h4>{{$nb}} match(es) found  for your query</h4>
								</div>

							</div>

						</div>
					</div>


					<div class="row">

						<div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
						
							<!-- Search Filter -->
							<div class="card search-filter">
								<div class="card-header">
									<h4 class="card-title mb-0">Search Filter</h4>
								</div>
								<div class="card-body">
									<form action="{{ route('search') }}" method="POST">
										@csrf
										<!--<div class="filter-widget">
											<div class="cal-icon">
												<input type="text" class="form-control datetimepicker" placeholder="Select Date">
											</div>			
										</div>-->
										<div class="filter-widget">
											<h4>Gender</h4>
											<div>
												<label class="custom_check">
													<input type="checkbox" name="gender" checked value="M">
													<span class="checkmark"></span> Male Doctor
												</label>
											</div>
											<div>
												<label class="custom_check">
													<input type="checkbox" name="gender" value="F">
													<span class="checkmark"></span> Female Doctor
												</label>
											</div>
										</div>

										<div class="filter-widget">
											<h4>Select Specialist</h4>

											@foreach($specialities as $speciality)
												<div>
													<label class="custom_check">
														<input type="checkbox" name="speciality_id" value="{{$speciality->id}}">
														<span class="checkmark"></span> {{$speciality->title}}
													</label>
												</div>

											@endforeach
											
										</div>

										<div class="filter-widget">
											<h4>Exercice Place</h4>
											<input type="text" placeholder="Enter a city name..." class="form-control" name="exercice_place">
										</div>

											<div class="btn-search">
												<button type="submit" class="btn btn-block">Search</button>
											</div>	
										</div>
								</form>
							</div>
							<!-- /Search Filter -->
							
						</div>

						<div class="col-md-12 col-lg-8 col-xl-9">

							@if($nb == 0)
								<div class="card">
									<div class="card-body">
										@include('inc.messages')

										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<strong>Error!</strong> No <a href="#" class="alert-link">Doctor</a>  found for your query. Please try to search again! 
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									</div>
								</div>

							@else
							<!-- Doctor Widget -->

							@foreach($doctors as $doctor)

							<div class="card">
								<div class="card-body">
									<div class="doctor-widget">
										<div class="doc-info-left">
											<div class="doctor-img">
												<a href="#">
													<img src="{{url('/storage/profile_images/'.$doctor->profile_picture ) }}" class="img-fluid" alt="User Image">
												</a>
											</div>
											<div class="doc-info-cont">
												<h4 class="doc-name"><a href="#">Dr. {{$doctor->name}} {{$doctor->firstname}}</a></h4>
												@if($doctor->speciality != '')
												<p class="doc-speciality">{{$doctor->speciality->title}}</p>
												
												<h5 class="doc-department"><img src="{{url('/storage/cover_images/'.$doctor->speciality->cover_image ) }}" class="img-fluid" alt="Speciality">{{$doctor->speciality->title}}</h5>
												@endif
												<div class="rating">
													<!--<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star filled"></i>
													<i class="fas fa-star"></i>
													<span class="d-inline-block average-rating">(17)</span>-->
													<input id="rating-system" type="number" class="rating" min="0" max="5" step="1" name="rating" value="{{ $doctor->averageRating }}" disabled>
												</div>
												<!--<div class="clinic-details">
													<p class="doc-location"><i class="fas fa-map-marker-alt"></i> Florida, USA</p>
													<ul class="clinic-gallery">
														<li>
															<a href="assets/img/features/feature-01.jpg" data-fancybox="gallery">
																<img src="assets/img/features/feature-01.jpg" alt="Feature">
															</a>
														</li>
														<li>
															<a href="assets/img/features/feature-02.jpg" data-fancybox="gallery">
																<img  src="assets/img/features/feature-02.jpg" alt="Feature">
															</a>
														</li>
														<li>
															<a href="assets/img/features/feature-03.jpg" data-fancybox="gallery">
																<img src="assets/img/features/feature-03.jpg" alt="Feature">
															</a>
														</li>
														<li>
															<a href="assets/img/features/feature-04.jpg" data-fancybox="gallery">
																<img src="assets/img/features/feature-04.jpg" alt="Feature">
															</a>
														</li>
													</ul>
												</div>-->
												<!--<div class="clinic-services">
													<span>Dental Fillings</span>
													<span> Whitneing</span>
												</div>-->
											</div>
										</div>
										<div class="doc-info-right">
											<div class="clini-infos">
												<ul>
													<!--<li><i class="far fa-thumbs-up"></i> 98%</li>
													<li><i class="far fa-comment"></i> 17 Feedback</li>-->
													<li><i class="fas fa-map-marker-alt"></i> {{$doctor->exercice_place}} , {{$doctor->country}} </li>
													<li><i class="far fa-money-bill-alt"></i> $300 <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i> </li>
												</ul>
											</div>
											<div class="clinic-booking">
												<a class="view-pro-btn" href="{{route('doctor.profile', $doctor->id)}}">View Profile</a>
												<a class="apt-btn" href="{{route('booking.doctor', $doctor->id)}}">Book Appointment</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Doctor Widget -->

							@endforeach
							@endif

							 <div class="load-more text-center">
								<!--<a class="btn btn-primary btn-sm" href="javascript:void(0);">Load More</a>	-->
								{{--{{ $doctors->links() }}--}}
							</div>	
						</div>
					
						

					</div>
				</div>

			</div>		
			<!-- /Page Content -->


		@include('website.footer')

		</div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>

		<script src="{{asset('js/star-rating.js') }}" type="text/javascript"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>

		<!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
		
		<!-- Select2 JS -->
		<script src="{{asset('assets/plugins/select2/js/select2.min.js') }}"></script>
		
		<!-- Datetimepicker JS -->
		<script src="{{asset('assets/js/moment.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
		
		<!-- Fancybox JS -->
		<script src="{{asset('assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>