<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>AAH+ - Mes Favoris</title>

		<!-- Favicons -->
        <link type="image/x-icon" href="{{asset('assets/img/favicon.png') }}" rel="icon">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
        
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
        
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
		<div class="main-wrapper" id="app">
		
			 <!-- Header -->
            @include('patients.partials.header')
            <!-- /Header -->

            <!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Favourites</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Favourites <span style="color: #26a9e166">+</span></h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->

			<!-- Page Content -->
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        
                        <!-- Profile Sidebar -->
                        @include('patients.partials.profile_side')
                        <!-- / Profile Sidebar -->

                        <div class="col-md-7 col-lg-8 col-xl-9">
							<div class="row row-grid">

								@forelse ($myFavorites as $myFavorite)
								<div class="col-md-6 col-lg-4 col-xl-3">
									<div class="profile-widget">
										<div class="doc-img">
											<a href="#">
												<img class="img-fluid" alt="User Image" src="{{url('/storage/profile_images/'.$myFavorite->profile_picture ) }}">
											</a>
											@if (Auth::check())
										        <favorite
										            :doctor={{ $myFavorite->id }}
										            :favorited={{ $myFavorite->favorited() ? 'true' : 'false' }}
										        ></favorite>
											@endif
										</div>
										<div class="pro-content">
											<h3 class="title">
												<a href="#">Dr. {{$myFavorite->name}} {{$myFavorite->firstname}}</a> 
												<i class="fas fa-check-circle verified"></i>
											</h3>
											<p class="speciality">{{$myFavorite->speciality->title}}</p>
											<div class="rating">
												<!--<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<i class="fas fa-star filled"></i>
												<span class="d-inline-block average-rating">(17)</span>-->
												<input id="rating-system" type="number" class="rating" min="0" max="5" step="1" name="rating" value="{{ $myFavorite->averageRating }}" disabled>
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
												<div class="col-6">
													<a href="{{route('doctor.profile', $myFavorite->id)}}" class="btn view-btn">View Profile</a>
												</div>
												<div class="col-6">
													<a href="{{route('booking.doctor', $myFavorite->id)}}" class="btn book-btn">Book Now</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								@empty
					                <p>You have no favourite Doctor.</p>
					            @endforelse
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

        <script src="{{asset('js/star-rating.js') }}" type="text/javascript"></script>

        <!-- Scripts -->
 		<script src="{{ asset('js/app.js') }}"></script>
        
        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
        
        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
        
    </body>