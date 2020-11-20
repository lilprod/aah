<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Telemed AAH - About</title>
		
		<!-- Favicons -->
		<link type="image/x-icon" href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css') }}">
		
		<link rel="stylesheet" type="text/css" href="{{asset('css/btn.css') }}">
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
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">About Us</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">About Us <span style="color: #26a9e166">+</span></h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->

			<!-- Page Content -->
			<!--<div class="content">
				<div class="container-fluid">

				</div>

			</div>	-->	
			<!-- /Page Content -->	

					<!-- Availabe Features -->
					<div class="row justify-content-center">
						<div class="col-md-8">

						   <section class="section section-features">
						   	<!-- Section Header -->
							<div class="section-header text-center">
								<h2>AAH<sup style="top: -.3em;">+</sup> POUR UNE BONNE SANTE POUR TOUS</h2>
								<!--<p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
							</div>
							<!-- /Section Header -->

								<div class="container-fluid">
								   <div class="row">
										<div class="col-md-5 features-img">
											<img src="{{asset('assets/img/about_us.png') }}" class="img-fluid" alt="Feature">
										</div>
										<div class="col-md-7">
											<div class="section-header">	
												<!--<h2 class="mt-2">Mot de bienveue</h2>-->
												<p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
												<p class="justify-content-center"><b>CEO Atasse Dovi</b></p>
											</div>
										</div>
								   </div>
								</div>
							</section>		
						</div>
					</div>
					<!-- /Availabe Features -->

					<!-- Cards -->
					<div class="row justify-content-center" style="background-color: #fcfcfc;">
						<div class="col-md-9">
							<!-- Section Header -->
							<div class="section-header text-center" style="padding-top: 80px">
								<h2>OUR TEAM</h2>
								<p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							</div>
							<!-- /Section Header -->
						<section class="comp-section comp-cards">
							<div class="row">
								<div class="col-12 col-md-6 col-lg-4 d-flex">
									<div class="card flex-fill">
										<img alt="Card Image" src="{{asset('assets/img/team1.jpg') }}" class="card-img-top">
										<div class="card-header">
											<h5 class="card-title mb-0">Card with image and links</h5>
										</div>
										<div class="card-body">
											<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
											<!--<a class="card-link" href="#">Card link</a>
											<a class="card-link" href="#">Another link</a>-->
										</div>
									</div>
								</div>

								<div class="col-12 col-md-6 col-lg-4 d-flex">
									<div class="card flex-fill">
										<img alt="Card Image" src="{{asset('assets/img/team2.jpg') }}" class="card-img-top">
										<div class="card-header">
											<h5 class="card-title mb-0">Card with image and button</h5>
										</div>
										<div class="card-body">
											<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
										</div>
									</div>
								</div>

								<div class="col-12 col-md-6 col-lg-4 d-flex">
									<div class="card flex-fill">
										<img alt="Card Image" src="{{asset('assets/img/team1.jpg') }}" class="card-img-top">
										<div class="card-header">
											<h5 class="card-title mb-0">Card with image and list</h5>
										</div>
										<div class="card-body">
											<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
										</div>
										<!--<ul class="list-group list-group-flush">
											<li class="list-group-item">Cras justo odio</li>
											<li class="list-group-item">Dapibus ac facilisis in</li>
											<li class="list-group-item">Vestibulum at eros</li>
										</ul>-->
									</div>
								</div>
							</div>
						</section>
					</div>
				</div>

				

				<!-- Cards -->
					<div class="row justify-content-center" style="background-color: #fcfcfc;">
						<div class="col-md-9">
						<section class="comp-section comp-cards">
							<!-- Section Header -->
							<div class="section-header text-center">
								<h2 class="mt-2">WHY CHOOSE <span style="color: #00A651;">AAH<sup style="color: #26A9E1; top: -.3em;">+</sup></span></h2>
								<p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							</div>
							<!-- /Section Header -->

							<div class="row">
								<div class="col-12 col-md-6 col-lg-4 d-flex">
									<div class="card flex-fill">
										<img alt="Card Image" src="assets/img/img-01.jpg" class="card-img-top">
										<!--<div class="card-header">
											<h5 class="card-title mb-0">Card with image and links</h5>
										</div>
										<div class="card-body">
											<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
											<a class="card-link" href="#">Card link</a>
											<a class="card-link" href="#">Another link</a>
										</div>-->
									</div>
								</div>

								<div class="col-12 col-md-6 col-lg-4 d-flex">
									<div class="card flex-fill">
										<img alt="Card Image" src="assets/img/img-01.jpg" class="card-img-top">
										<!--<div class="card-header">
											<h5 class="card-title mb-0">Card with image and button</h5>
										</div>
										<div class="card-body">
											<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
										</div>-->
									</div>
								</div>

								<div class="col-12 col-md-6 col-lg-4 d-flex">
									<div class="card flex-fill">
										<img alt="Card Image" src="assets/img/img-01.jpg" class="card-img-top">
										<!--<div class="card-header">
											<h5 class="card-title mb-0">Card with image and list</h5>
										</div>
										<div class="card-body">
											<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
										</div>
										<ul class="list-group list-group-flush">
											<li class="list-group-item">Cras justo odio</li>
											<li class="list-group-item">Dapibus ac facilisis in</li>
											<li class="list-group-item">Vestibulum at eros</li>
										</ul>
									</div>-->
								</div>
							</div>
						</section>
					</div>
				</div>


				<!-- Availabe Features -->
					<div class="row justify-content-center">
						<div class="col-md-8">

						   <section class="section section-features">

								<div class="container-fluid">
								   <div class="row">
										<div class="col-md-5 features-img">
											<img src="{{asset('assets/img/apk.png') }}" class="img-fluid" alt="Feature">
										</div>
										<div class="col-md-7">
											<div class="section-header">	
												<h2 class="mt-2">DOWNLOAD <span style="color: #00A651;">AAH<sup style="color: #26A9E1; top: -.3em;">+</sup></span> APP NOW!</h2>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
											</div>

											<div class="view-all left-right">
												<a href="#" class="btn" style="padding: 0px 0px;"><img src="{{asset('assets/img/app.svg') }}" alt=""></a> 
												<a href="#" class="btn" style="padding: 0px 0px;"><img src="{{asset('assets/img/play.svg') }}" alt=""></a>
											</div>
										</div>
								   </div>
								</div>
							</section>		
						</div>
					</div>
					<!-- /Availabe Features -->

		<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>

		@include('website.footer')

		</div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>

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
		
		<!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
		
		<!-- Slick JS -->
		<script src="{{asset('assets/js/slick.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>