<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>AAH+ - Doctors</title>
		
		<!-- Favicons -->
		<link type="image/x-icon" href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">

		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css') }}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css') }}">

		<link rel="stylesheet" type="text/css" href="{{asset('css/btn.css') }}">

		<link href="{{asset('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>

	<body>
	
	<!-- Loader -->
	<!--<div id="loader">
		<div class="loader">
			<span></span>
			<span></span>
		</div>
	</div>-->
	<!-- /Loader  -->

		<!-- Main Wrapper -->
		<div class="main-wrapper" id="app">
			
			@include('website.hearder')

			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

	            <div class="row">
	            	<div class="col-md-6 col-lg-12">
					<!--<div class="col-xl-6 col-lg-12 order-md-last order-sm-last order-last map-left">-->
				
						<div class="row align-items-center mb-4">
							<div class="col-md-6 col">
								<h4>{{count($doctors)}} Doctors found</h4>
							</div>

							<div class="col-md-6 col-auto">
								<div class="view-icons ">
									<a href="{{route('our_doctors')}}" class="grid-view active"><i class="fas fa-th-large"></i></a>
									<a href="{{route('list_doctors')}}" class="list-view"><i class="fas fa-bars"></i></a>
								</div>
								<!--<div class="sort-by d-sm-block d-none">
									<span class="sortby-fliter">
										<select class="select">
											<option>Sort by</option>
											<option class="sorting">Rating</option>
											<option class="sorting">Popular</option>
											<option class="sorting">Latest</option>
											<option class="sorting">Free</option>
										</select>
									</span>
								</div>-->
							</div>
						</div>
						<flash message=""></flash>

							<div class="row">


								@foreach($doctors as $doctor)

								<div class="col-md-3">
									<!--<div class="col-sm-6 col-md-4 col-xl-6">-->
									<div class="profile-widget">
										<div class="doc-img">
											<a href="{{route('doctor.profile', $doctor->id)}}">
												<img class="img-fluid" alt="User Image" src="{{url('/storage/profile_images/'.$doctor->profile_picture ) }}">
											</a>
											@if ((Auth::check()) && (Auth()->user()->role_id == 1))
										        <favorite
										            :doctor={{ $doctor->id }}
										            :favorited={{ $doctor->favorited() ? 'true' : 'false' }}
										        ></favorite>
											@endif
											<!--<a href="javascript:void(0)" class="fav-btn">
												<i class="far fa-bookmark"></i>
											</a>-->
										</div>
										<div class="pro-content">
											<h3 class="title">
												<a href="{{route('doctor.profile', $doctor->id)}}">Dr. {{$doctor->name}} {{$doctor->firstname}}</a> 
												<i class="fas fa-check-circle verified"></i>
											</h3>
											@if($doctor->speciality_id != '')
											<p class="speciality">{{$doctor->speciality->title}}</p>
											@endif
											<div class="rating">
												<!--<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>-->
												<input id="rating-system" type="number" class="rating" min="0" max="5" step="1" name="rating" value="{{ $doctor->averageRating }}" disabled>
												<!--<span class="d-inline-block average-rating">({{ $doctor->averageRating }})</span>-->
											</div>
											<!--<ul class="available-info">
												<li>
													<i class="fas fa-map-marker-alt"></i> Florida, USA
												</li>
												<li>
													<i class="far fa-clock"></i> Available on Fri, 22 Mar
												</li>
												<li>
													<i class="far fa-money-bill-alt"></i> $300 - $1000 <i class="fas fa-info-circle" data-toggle="tooltip" title="Lorem Ipsum"></i>
												</li>
											</ul>-->
											<div class="row row-sm">
												<div class="col-4">
													<a href="{{route('doctor.profile', $doctor->id)}}" class="btn view-btn">View Profile</a>
												</div>
												<div class="col-4">
													<a href="{{route('booking.doctor', $doctor->id)}}" class="btn book-btn">Book Now</a>
												</div>
												@auth
												@if(auth()->user()->role_id == 1)
												<div class="col-4">
													<a href="{{route('rating.doctor', $doctor->id)}}" class="btn view-btn">Rating Now</a>
												</div>
												@endif
												@endauth
											</div>
										</div>
									</div>
								</div>

								@endforeach
						</div>
							
					<!--<div class="load-more text-center">
						<a class="btn btn-primary btn-sm" href="javascript:void(0);">Load More</a>	
					</div>-->
	            </div>

	            <!-- /content-left-->
	            {{--<div class="col-xl-6 col-lg-12 map-right">
	                <div id="map" class="map-listing"></div>
	                <!-- map-->
	            </div>--}}
			<!-- /map-right-->

	        </div>
	        <!-- /row-->
	   
				</div>

			</div>		
			<!-- /Page Content -->
			<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
			@include('website.footer')
		</div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>

		<script src="{{asset('js/star-rating.js') }}" type="text/javascript"></script>

		<!-- Scripts -->
 		<script src="{{ asset('js/app.js') }}"></script>

		<script type="text/javascript">
			// When the user scrolls down 20px from the top of the document, show the button
			window.onscroll = function() {scrollFunction()};

			function scrollFunction() {
			  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			    document.getElementById("myBtn").style.display = "block";
			  } else {
			    document.getElementById("myBtn").style.display = "none";
			  }
			}

			// When the user clicks on the button, scroll to the top of the document
			function topFunction() {
			  document.body.scrollTop = 0; // For Safari
			  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
			}
		</script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>

		<!-- Select2 JS -->
		<script src="{{asset('assets/plugins/select2/js/select2.min.js') }}"></script>


		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6adZVdzTvBpE2yBRK8cDfsss8QXChK0I"></script>
		<script src="{{asset('assets/js/map.js') }}"></script>
		
	</body>
</html>