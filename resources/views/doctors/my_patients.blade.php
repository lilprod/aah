<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - My Patients</title>
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
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">My Patients</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">My Patients <span style="color: #26a9e166">+</span></h2>
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
						
							<div class="row row-grid">
								@forelse($mypatients as $patient)
								<div class="col-md-6 col-lg-4 col-xl-3">
									<div class="card widget-profile pat-widget-profile">
										<div class="card-body">
											<div class="pro-widget-content">
												<div class="profile-info-widget">
													<a href="{{route('patient.profile', $patient->id)}}" class="booking-doc-img">
														<img src="{{url('/storage/profile_images/'.$patient->profile_picture ) }}" alt="User Image">
													</a>
													<div class="{{route('patient.profile', $patient->id)}}">
														<h3><a href="{{route('patient.profile', $patient->id)}}">{{$patient->name}} {{$patient->firstname}}</a></h3>
														
														<div class="patient-details">
															<h5><b>Patient ID :</b> PT00{{$patient->id}}</h5>
															@if($patient->address != '')
															<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{$patient->address}}</h5>
															@endif 
														</div>
													</div>
												</div>
											</div>
											<div class="patient-info">
												<ul>
													<li>Phone <span>{{$patient->phone_number}}</span></li>
													<li>Age <span>
														@if($patient->birth_date != '') 
															@php
																$birthday = new DateTime($patient->birth_date);
															    $currentDate = new DateTime(date("Y-m-d"));
															    $interval = $birthday->diff($currentDate);

															    $age= $interval->format('%Y');

															  	echo($age.' Year, ');
															@endphp
														@endif

														@if($patient->gender != '') 
															@if($patient->gender == 'M') 
																Male 
															@else
																Female
															@endif

														@endif
													</span>

													</li>
													<li>Blood Group <span>{{$patient->blood_group}}{{$patient->rhesus}}</span></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								@empty
					                <p>You don't have any Patients yet!</p>
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