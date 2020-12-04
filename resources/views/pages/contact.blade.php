<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Telemed AAH - Contact</title>
		
		<!-- Favicons -->
		<link type="image/x-icon" href="assets/img/favicon.png" rel="icon">
		
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

		@include('website.hearder')

		<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Contact Us</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Contact Us <span style="color: #26a9e166">+</span></h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->

			<!-- Page Content -->
			<div class="content">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!--<h5>Contact Page</h5>-->
							
							<div class="row">
								<div class="col-md-4">
									<div class="card">
										<!--<div class="card-header">
											<h4 class="card-title">Contact Information</h4>
										</div>-->
										<div class="card-body">

											<div class="single-contact-address">
												<div class="contact-details">
													
													<h5 class="card-title">CONTACTS INFO</h5>
													<p class="mb-2">
														<i class="fas fa-home"></i> 
														11 Lome Boul - Lomé, TOGO
													</p>
													<p class="mb-2">
														<i class="fas fa-phone-alt"></i> 
														+1 315 369 5943
													</p>
													<p class="mb-2">
														<i class="fas fa-envelope"></i> 
														info@aah.care
													</p>
												</div>
											</div><br>

											<div class="single-contact-address">
												<div class="contact-details">
													
													<h5 class="card-title">INVESTOR INFO</h5>
													<p class="mb-2">
														<i class="fas fa-home"></i> 
														11 Lome Boul - Lomé, TOGO
													</p>
													<p class="mb-2">
														<i class="fas fa-phone-alt"></i>
														+1 315 369 5943
													</p>
													<p class="mb-2">
														<i class="fas fa-envelope"></i> 
														investor@aah.care
													</p>
												</div>
											</div><br>

											<div class="single-contact-address">
												<div class="contact-details">
													
													<h5 class="card-title">MEDIA INFO</h5>
													<p class="mb-2">
														<i class="fas fa-home"></i> 
														11 Lome Boul - Lomé, TOGO
													</p>
													<p class="mb-2">
														<i class="fas fa-phone-alt"></i> 
														+1 315 369 5943
													</p>
													<p class="mb-2">
														<i class="fas fa-envelope"></i> 
														media@aah.care
													</p>
												</div>
											</div>

											<!--<div class="single-contact-address">
							
												<div class="contact-details">
													
													<h5><span class="fas fa-home"></span> 3556 Beech Street, San Francisco,</h5>
													<p>
														California, CA 94108
													</p>
												</div>
											</div>
											<div class="single-contact-address">
										
												<div class="contact-details">
													
													<h5> <span class="fas fa-phone-alt"></span> +1 315 369 5943</h5>
													<p>Mon to Fri 9am to 6 pm</p>
												</div>
											</div>
											<div class="single-contact-address">
												
												<div class="contact-details">
													
													<h5> <span class="fas fa-envelope"></span> contact@aahsolution.com</h5>
													<p>Send us your query anytime!</p>
												</div>
											</div>-->
										</div>
									</div>
								</div>

								<div class="col-md-8">
									@include('inc.messages')
									<div class="card">
										<!--<div class="card-header">
											<h4 class="card-title">Love to hear from you</h4>
										</div>-->
									<form class="form-area" id="myForm" action="{{route('postcontact')}}" method="POST">
										<div class="card-body">
											
											{{csrf_field()}}
											<div class="row">

												<div class="col-12 col-md-6">	
													<div class=" form-group">
														<input name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="form-control" required="" type="text">
													</div>
												</div>

												<div class="col-12 col-md-6">	
													<div class=" form-group">
														<input name="firstname" placeholder="Enter your firstname" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your firstname'" class="form-control" required="" type="text">
													</div>
												</div>
													
												<div class="col-12 col-md-6">	
													<div class="form-group">
														<input name="email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="form-control" required="" type="email">
													</div>
												</div>

												<div class="col-12 col-md-6">	
													<div class="form-group">
														<input name="phone_number" placeholder="Enter Phone number"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Phone number'" class="form-control" required="" type="text">
													</div>
												</div>

												<div class="col-12 col-md-12">	
													<div class=" form-group">
														<input name="subject" placeholder="Enter subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter subject'" class="form-control" required="" type="text">
													</div>
												</div>

												<div class="col-12 col-md-12">	
													<div class="form-group" >
														<textarea class="form-control" name="message" placeholder="Enter Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Messege'" required="" rows="7"></textarea>				
													</div>
												</div>

												<div class="col-12 col-md-12">
													<button class="btn btn-primary btn-rounded" style="float: right;" type="submit">Send Message</button>				
												</div>

											</div>

									</div>
								</form>

									</div>

								</div>

							</div>

						</div>
					</div>
				</div>

			</div>	

			<div class="map-wrap" style="width:100%; height: 445px;"  id="map"></div>
			
			<!-- End contact-page Area -->	
			<!-- /Page Content -->


		@include('website.footer')

		</div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>

		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>

		<script>

		    if (document.getElementById("map")) {
		        google.maps.event.addDomListener(window, 'load', init);

		        function init() {
		            var mapOptions = {
		                zoom: 11,
		                center: new google.maps.LatLng(40.6700, -73.9400), // New York
		                styles: [{
		                    "featureType": "water",
		                    "elementType": "geometry",
		                    "stylers": [{
		                        "color": "#e9e9e9"
		                    }, {
		                        "lightness": 17
		                    }]
		                }, {
		                    "featureType": "landscape",
		                    "elementType": "geometry",
		                    "stylers": [{
		                        "color": "#f5f5f5"
		                    }, {
		                        "lightness": 20
		                    }]
		                }, {
		                    "featureType": "road.highway",
		                    "elementType": "geometry.fill",
		                    "stylers": [{
		                        "color": "#ffffff"
		                    }, {
		                        "lightness": 17
		                    }]
		                }, {
		                    "featureType": "road.highway",
		                    "elementType": "geometry.stroke",
		                    "stylers": [{
		                        "color": "#ffffff"
		                    }, {
		                        "lightness": 29
		                    }, {
		                        "weight": 0.2
		                    }]
		                }, {
		                    "featureType": "road.arterial",
		                    "elementType": "geometry",
		                    "stylers": [{
		                        "color": "#ffffff"
		                    }, {
		                        "lightness": 18
		                    }]
		                }, {
		                    "featureType": "road.local",
		                    "elementType": "geometry",
		                    "stylers": [{
		                        "color": "#ffffff"
		                    }, {
		                        "lightness": 16
		                    }]
		                }, {
		                    "featureType": "poi",
		                    "elementType": "geometry",
		                    "stylers": [{
		                        "color": "#f5f5f5"
		                    }, {
		                        "lightness": 21
		                    }]
		                }, {
		                    "featureType": "poi.park",
		                    "elementType": "geometry",
		                    "stylers": [{
		                        "color": "#dedede"
		                    }, {
		                        "lightness": 21
		                    }]
		                }, {
		                    "elementType": "labels.text.stroke",
		                    "stylers": [{
		                        "visibility": "on"
		                    }, {
		                        "color": "#ffffff"
		                    }, {
		                        "lightness": 16
		                    }]
		                }, {
		                    "elementType": "labels.text.fill",
		                    "stylers": [{
		                        "saturation": 36
		                    }, {
		                        "color": "#333333"
		                    }, {
		                        "lightness": 40
		                    }]
		                }, {
		                    "elementType": "labels.icon",
		                    "stylers": [{
		                        "visibility": "off"
		                    }]
		                }, {
		                    "featureType": "transit",
		                    "elementType": "geometry",
		                    "stylers": [{
		                        "color": "#f2f2f2"
		                    }, {
		                        "lightness": 19
		                    }]
		                }, {
		                    "featureType": "administrative",
		                    "elementType": "geometry.fill",
		                    "stylers": [{
		                        "color": "#fefefe"
		                    }, {
		                        "lightness": 20
		                    }]
		                }, {
		                    "featureType": "administrative",
		                    "elementType": "geometry.stroke",
		                    "stylers": [{
		                        "color": "#fefefe"
		                    }, {
		                        "lightness": 17
		                    }, {
		                        "weight": 1.2
		                    }]
		                }]
		            };
		            var mapElement = document.getElementById('map');
		            var map = new google.maps.Map(mapElement, mapOptions);
		            var marker = new google.maps.Marker({
		                position: new google.maps.LatLng(40.6700, -73.9400),
		                map: map,
		                title: 'Snazzy!'
		            });
		        }
		    }
		</script>
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Slick JS -->
		<script src="{{asset('assets/js/slick.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>