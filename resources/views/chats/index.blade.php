<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">

        <meta name="csrf-token" content="{{ csrf_token() }}">


		<title>Telemed AAH - Chat</title>
		
		<script src="{{ mix('js/app.js') }}" defer></script>
		<!-- Favicons -->
		<link type="image/x-icon" href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
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
	<body class="chat-page">
		<!-- Main Wrapper -->
		<div class="main-wrapper" id="app">
		@include('website.hearder')

		<!-- Breadcrumb -->
			<!--<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Chats</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Chats</h2>
						</div>
					</div>
				</div>
			</div>-->
			<!-- /Breadcrumb -->

			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12">

							<chat-component :user="{{ auth()->user() }}"></chat-component>

						</div>
             		</div>
             	</div>	
			</div>		
			<!-- /Page Content -->

	    <audio id="chat-alert-sound" style="display: none">
	        <source src="{{ asset('sound/facebook_chat.mp3') }}" />
	    </audio>


		@include('website.footer')

		</div>
	   <!-- /Main Wrapper -->
	  
		
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Slick JS -->
		<script src="{{asset('assets/js/slick.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>