<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Telemed AAH - Contact</title>
		
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
									<li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Privacy Policy</h2>
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
							<div class="terms-content">
								<div class="terms-text">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel sodales mauris. Nunc accumsan mi massa, ut maximus magna ultricies et:</p>
									<ol>
										<li>Integer quam odio, ullamcorper id diam in, accumsan convallis libero. Duis at lacinia urna.</li>
										<li>Mauris eget turpis sit amet purus pulvinar facilisis at sed lacus.</li>
										<li>Quisque malesuada volutpat orci, accumsan scelerisque lorem pulvinar vitae.</li>
										<li>Vestibulum sit amet sem aliquam, vestibulum nisi sed, sodales libero.</li>
									</ol>
								</div>
								<div class="terms-text">
									<h4>Aenean accumsan aliquam justo, et rhoncus est ullamcorper at</h4>
									<p>Donec posuere dictum enim, vel sollicitudin orci tincidunt ac. Maecenas mattis ex eu elit tincidunt egestas. Vivamus posuere nunc vel metus bibendum varius. Vestibulum suscipit lacinia eros a aliquam. Sed dapibus arcu eget egestas hendrerit.</p>

									<p>Vivamus consectetur metus at nulla efficitur mattis. Aenean egestas eu odio vestibulum vestibulum. Duis nulla lectus, lacinia vitae nibh vitae, sagittis interdum lacus. Mauris lacinia leo odio, eget finibus lectus pharetra ut. Nullam in semper enim, id gravida nulla.</p>

									<p>Fusce gravida auctor justo, vel lobortis sem efficitur id. Cras eu eros vitae justo dictum tempor.</p>
								</div>
								<div class="terms-text">
									<h4>Etiam sed fermentum lectus. Quisque vitae ipsum libero</h4>
									<p>Phasellus sit amet vehicula arcu. Etiam pulvinar dui libero, vitae fringilla nulla convallis in. Fusce sagittis cursus nisl, at consectetur elit vestibulum vestibulum:</p>
									<ul>
										<li>Nunc pulvinar efficitur interdum.</li>
										<li>Donec feugiat feugiat pulvinar.</li>
										<li>Suspendisse eu risus feugiat, pellentesque arcu eu, molestie lorem. </li>
										<li>Duis non leo commodo, euismod ipsum a, feugiat libero.</li>
									</ul>
								</div>
								<div class="terms-text">
									<h4>pulvinar</h4> 
									<p>Sed sollicitudin, diam nec tristique tincidunt, nulla ligula facilisis nunc, non condimentum tortor leo id ex.</p>

									<p>Vivamus consectetur metus at nulla efficitur mattis. Aenean egestas eu odio vestibulum vestibulum. Duis nulla lectus, lacinia vitae nibh vitae, sagittis interdum lacus. Mauris lacinia leo odio, eget finibus lectus pharetra ut. Nullam in semper enim, id gravida nulla.</p>

									<p>Donec posuere dictum enim, vel sollicitudin orci tincidunt ac. Maecenas mattis ex eu elit tincidunt egestas. Vivamus posuere nunc vel metus bibendum varius. Vestibulum suscipit lacinia eros a aliquam. Sed dapibus arcu eget egestas hendrerit.Donec posuere dictum enim, vel sollicitudin orci tincidunt ac. Maecenas mattis ex eu elit tincidunt egestas. Vivamus posuere nunc vel metus bibendum varius. Vestibulum suscipit lacinia eros a aliquam. Sed dapibus arcu eget egestas hendrerit.</p>
								</div>
								<div class="terms-text">
									<h4>efficitur</h4>

									<p>Fusce gravida auctor justo, vel lobortis sem efficitur id. Cras eu eros vitae justo dictum tempor.</p>

									<p><strong>Vivamus posuere nunc vel metus bibendum varius. Vestibulum suscipit lacinia eros a aliquam. Sed dapibus arcu eget egestas hendrerit.Donec posuere dictum enim, vel sollicitudin orci tincidunt ac.</strong></p>
								</div>	
							</div>
						</div>
					</div>
				</div>

			</div>		
			<!-- /Page Content -->

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
		
		<!-- Slick JS -->
		<script src="{{asset('assets/js/slick.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>