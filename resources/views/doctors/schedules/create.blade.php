<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - Add Schedule Timing</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">

		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fancybox/jquery.fancybox.min.css') }}">
		
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
									<li class="breadcrumb-item active" aria-current="page">Add Post</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Add Time Slots</h2>
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
							<form method="POST" action="{{ route('schedules.store') }}" enctype="multipart/form-data">
        					{{csrf_field()}}
							<!-- Basic Information -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">New Time Slots</h4>
									<div class="row form-row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Day</label>
												<select class="form-control select" name="day_num">
													<option value="1">Monday</option>
													<option value="2">Tuesday</option>
													<option value="3">Wednesday</option>
													<option value="4">Thursday</option>
													<option value="5">Friday</option>
													<option value="6">Saturday</option>
													<option value="7">Sunday</option>
												</select>
											</div>
										</div>
										
										<div class="col-md-4">
											<div class="form-group">
												 <label>Start Time <span class="text-danger">*</span></label>
                								<!--<input class="form-control" type="text" name="begintime" id="begintime">-->
                								<select class="select" name="begin_time" id="begin_time" required>
						                           <!-- <option value = "" disabled="disabled">--Select Hour--</option>-->
						                            <option value = "07:00">07:00</option>
						                            <!--<option value="07:30">07:30</option>-->
						                            <option value="08:00">08:00</option>
						                            <!--<option value="08:30">08:30</option>-->
						                            <option value = "09:00">09:00</option>
						                            <!--<option value="09:30">09:30</option>-->
						                            <option value = "10:00">10:00</option>
						                            <!--<option value="10:30">10:30</option>-->
						                            <option value = "11:00">11:00</option>
						                            <!--<option value="11:30">11:30</option>-->
						                            <option value = "14:00">14:00</option>
						                            <!--<option value="14:30">14:30</option>-->
						                            <option value = "15:00">15:00</option>
						                            <!--<option value="15:30">15:30</option>-->
						                            <option value = "16:00">16:00</option>
						                            <!--<option value="16:30">16:30</option>-->
						                        </select>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">

												<label>End Time <span class="text-danger">*</span></label>
                								<!--<input class="form-control" type="text" name="slug" id="slug">-->
                								<select class="select" name="end_time" id="end_time" required>
						                            <!--<option value = "" disabled="disabled">--Select Hour--</option>-->
						                            <!--<option value = "07:00">07:00</option>-->
						                            <option value="07:30">07:30</option>
						                            <!--<option value="08:00">08:00</option>-->
						                            <option value="08:30">08:30</option>
						                            <!--<option value = "09:00">09:00</option>-->
						                            <option value="09:30">09:30</option>
						                            <!--<option value = "10:00">10:00</option>-->
						                            <option value="10:30">10:30</option>
						                            <!--<option value = "11:00">11:00</option>-->
						                            <option value="11:30">11:30</option>
						                            <!--<option value = "14:00">14:00</option>-->
						                            <option value="14:30">14:30</option>
						                            <!--<option value = "15:00">15:00</option>-->
						                            <option value="15:30">15:30</option>
						                            <!--<option value = "16:00">16:00</option>-->
						                            <option value="16:30">16:30</option>
						                        </select>
											</div>
										</div>

									</div>

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
		
		<!-- Select2 JS -->
		<script src="{{asset('assets/plugins/select2/js/select2.min.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>