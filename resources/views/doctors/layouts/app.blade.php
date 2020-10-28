<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <!-- CSRF Token -->
    	<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>Telemed AAH - Doctor Dashboard</title>

		<!-- Scripts -->
 		<script src="{{ asset('js/app.js') }}" defer></script>
		
		<!-- Favicons -->
		<link type="image/x-icon" href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css') }}">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}">
		
		<link rel="stylesheet" href="{{asset('assets/plugins/dropzone/dropzone.min.css') }}">
		
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

			@yield('content')

			@include('website.footer')

		</div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>

		@stack('post')
		@stack('slug')

		<script src="{{ asset('ckeditor/ckeditor.js')}}"></script> 

		<script> CKEDITOR.replace('article-ckeditor'); </script>
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Slick JS -->
		<script src="{{asset('assets/js/slick.js') }}"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
		
		<!-- Select2 JS -->
		<script src="{{asset('assets/plugins/select2/js/select2.min.js') }}"></script>
		
		<!-- Dropzone JS -->
		<script src="{{asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
		
		<!-- Bootstrap Tagsinput JS -->
		<script src="{{asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>

		<!-- Circle Progress JS -->
		<script src="{{asset('assets/js/circle-progress.min.js') }}"></script>
		
		<!-- Profile Settings JS -->
		<script src="{{asset('assets/js/profile-settings.js') }}"></script>

		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>