<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AAH+ - Doctor Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        
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
									<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Dashboard <span style="color: #26a9e166">+</span></h2>
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

							<div class="row">
			                    <div class="col-md-12">
			                        @include('inc.messages')
			                    </div>
			                </div>

							<div class="row">
								<div class="col-md-12">
									<div class="card dash-card">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12 col-lg-4">
													<div class="dash-widget dct-border-rht">
														<div class="circle-bar circle-bar1">
															<div class="circle-graph1" data-percent="{{count($doctor->patients)}}">
																<img src="{{asset('assets/img/icon-01.png') }}" class="img-fluid" alt="patient">
															</div>
														</div>
														<div class="dash-widget-info">
															<h6>Total Patient</h6>
															<h3>{{count($doctor->patients)}}</h3>
															<p class="text-muted">Till Today</p>
														</div>
													</div>
												</div>
												
												<div class="col-md-12 col-lg-4">
													<div class="dash-widget dct-border-rht">
														<div class="circle-bar circle-bar2">
															<div class="circle-graph2" data-percent="{{count($todayapts)}}">
																<img src="{{asset('assets/img/icon-02.png') }}" class="img-fluid" alt="Patient">
															</div>
														</div>
														<div class="dash-widget-info">
															<h6>Today Patient</h6>
															<h3>{{count($todayapts)}}</h3>
															<p class="text-muted">{{$today->format('d/m/Y')}}</p>
														</div>
													</div>
												</div>
												
												<div class="col-md-12 col-lg-4">
													<div class="dash-widget">
														<div class="circle-bar circle-bar3">
															<div class="circle-graph3" data-percent="{{count($upcomapts)}}">
																<img src="{{asset('assets/img/icon-03.png') }}" class="img-fluid" alt="Patient">
															</div>
														</div>
														<div class="dash-widget-info">
															<h6>Appoinments</h6>
															<h3>{{count($upcomapts)}}</h3>
															<!--<p class="text-muted">06, Apr 2019</p>-->
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12">
									<h4 class="mb-4">Patient Appoinment</h4>
									<div class="appointment-tab">
									
										<!-- Appointment Tab -->
										<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
											<li class="nav-item">
												<a class="nav-link active" href="#upcoming-appointments" data-toggle="tab">Upcoming</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#today-appointments" data-toggle="tab">Today</a>
											</li> 
										</ul>
										<!-- /Appointment Tab -->
										
										<div class="tab-content">
										
											<!-- Upcoming Appointment Tab -->
											<div class="tab-pane show active" id="upcoming-appointments">
												<div class="card card-table mb-0">
													<div class="card-body">
														<div class="table-responsive">
															<table class="table table-hover table-center mb-0">
																<thead>
																	<tr>
																		<th>Patient Name</th>
																		<th>Appt Date</th>
																		<th>Purpose</th>
																		<th>Type</th>
																		<th class="text-center">Paid Amount</th>
																		<th></th>
																	</tr>
																</thead>
																<tbody>
																	@foreach($upcomapts as $i=>$appointment)
																	<tr>
																		<td>
																			<h2 class="table-avatar">
																				<a href="{{route('patient.profile', $appointment->patient_id)}}" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="assets/img/patients/patient.jpg" alt="User Image"></a>
																				<a href="{{route('patient.profile', $appointment->patient_id)}}">{{$appointment->patient->name}} <span>#PT0016</span></a>
																			</h2>
																		</td>
																		<td>{{$appointment->date_apt}} <span class="d-block text-info">{{$appointment->begin_time}}</span></td>
																		<td>General</td>
																		<td>New Patient</td>
																		<td class="text-center">${{$appointment->apt_amount}}</td>
																		<td class="text-right">
																			<div class="table-action">
																				<a href="javascript:void(0);" class="btn btn-sm bg-info-light" data-toggle="modal" data-target="#upcomapts_details{{$i}}">
																					<i class="far fa-eye"></i> View
																				</a>
																				@if($appointment->status == 0)
																				<a href="javascript:void(0);" class="btn btn-sm bg-success-light">
																					<i class="fas fa-check"></i> Accept
																				</a>
																				@endif

																				@if($appointment->status == 0)
																				<a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
																					<i class="fas fa-times"></i> Cancel
																				</a>
																				@endif

																				@if($appointment->status == 1)
																				<a href="{{route('appointment.start', $appointment->id)}}" class="btn btn-sm bg-primary-light">
																					<i class="fas fa-play"></i> Start
																				</a>
																				@endif

																				@if($appointment->status == 1)
																				<a href="javascript:void(0);" class="btn btn-sm bg-danger-light" data-toggle="modal" data-target="#finish_appointment" onclick="finishData({{ $appointment->id}})">
																					<i class="fas fa-flag-checkered"></i> Finish
																				</a>
																				@endif
																			</div>
																		</td>
																	</tr>
																	@endforeach
																</tbody>
															</table>		
														</div>
													</div>
												</div>
											</div>
											<!-- /Upcoming Appointment Tab -->
									   
											<!-- Today Appointment Tab -->
											<div class="tab-pane" id="today-appointments">
												<div class="card card-table mb-0">
													<div class="card-body">
														<div class="table-responsive">
															<table class="table table-hover table-center mb-0">
																<thead>
																	<tr>
																		<th>Patient Name</th>
																		<th>Appt Date</th>
																		<th>Purpose</th>
																		<th>Type</th>
																		<th class="text-center">Paid Amount</th>
																		<th></th>
																	</tr>
																</thead>
																<tbody>
																	@foreach($todayapts as $j=>$appointment)
																	<tr>
																		<td>
																			<h2 class="table-avatar">
																				<a href="{{route('patient.profile', $appointment->patient_id)}}" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="assets/img/patients/patient6.jpg" alt="User Image"></a>
																				<a href="{{route('patient.profile', $appointment->patient_id)}}">{{$appointment->patient->name}} <span>#PT0006</span></a>
																			</h2>
																		</td>
																		<td>{{$appointment->date_apt}} <span class="d-block text-info">{{$appointment->begin_time}}</span></td>
																		<td>Fever</td>
																		<td>Old Patient</td>
																		<td class="text-center">${{$appointment->apt_amount}}</td>
																		<td class="text-right">
																			<div class="table-action">
																				<a href="javascript:void(0);" class="btn btn-sm bg-info-light" data-toggle="modal" data-target="#todayapts_details{{$j}}">
																					<i class="far fa-eye"></i> View
																				</a>
																				
																				@if($appointment->status == 0)
																				<a href="javascript:void(0);" class="btn btn-sm bg-success-light">
																					<i class="fas fa-check"></i> Accept
																				</a>
																				@endif

																				@if($appointment->status == 0)
																				<a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
																					<i class="fas fa-times"></i> Cancel
																				</a>
																				@endif

																				@if($appointment->status == 1)
																				<a href="{{route('appointment.start', $appointment->id)}}" class="btn btn-sm bg-primary-light">
																					<i class="fas fa-play"></i> Start
																				</a>
																				@endif

																				@if($appointment->status == 1)
																				<a href="javascript:void(0);" class="btn btn-sm bg-danger-light" data-toggle="modal" data-target="#finish_appointment" onclick="finishData({{ $appointment->id}})">
																					<i class="fas fa-flag-checkered"></i> Finish
																				</a>
																				@endif
																			</div>
																		</td>
																	</tr>
																	@endforeach
																</tbody>
															</table>		
														</div>	
													</div>	
												</div>	
											</div>
											<!-- /Today Appointment Tab -->
											
										</div>
									</div>
								</div>
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
        <!-- Appointment Details Modal -->
		@foreach($upcomapts as $i=>$appointment)
		<div class="modal fade custom-modal" id="upcomapts_details{{$i}}">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Appointment Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<ul class="info-details">
							<li>
								<div class="details-header">
									<div class="row">
										<div class="col-md-6">
											<span class="title">#APT00{{$appointment->id}} </span>
											<span class="text">{{$appointment->date_apt}} {{$appointment->begin_time}}</span>
										</div>
										<div class="col-md-6">
											<div class="text-right">
												@if($appointment->status == 0)
												<button type="button" class="btn bg-warning-light btn-sm" id="topup_status">Pending</button>
												@endif
												@if($appointment->status == 1)
												<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Confirmed</button>
												@endif
												@if($appointment->status == 2)
												<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Cancelled</button>
												@endif
												@if($appointment->status == 3)
												<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Completed</button>
												@endif
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<span class="title">Status:</span>
								@if($appointment->status == 0)
								<span class="text">Pending</span>
								@endif
								@if($appointment->status == 1)
								<span class="text">Confirmed</span>
								@endif
								@if($appointment->status == 2)
								<span class="text">Cancelled</span>
								@endif
								@if($appointment->status == 3)
								<span class="text">Completed</span>
								@endif
							</li>

							@if($appointment->confirm_date != '')
							<li>
								<span class="title">Confirm Date:</span>
								<span class="text">{{$appointment->confirm_date}}</span>
							</li>
							@endif
							<li>
								<span class="title">Paid Amount</span>
								<span class="text">${{$appointment->apt_amount}}</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		@endforeach
		<!-- /Appointment Details Modal -->

		@foreach($todayapts as $j=>$appointment)
		<div class="modal fade custom-modal" id="todayapts_details{{$i}}">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Appointment Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<ul class="info-details">
							<li>
								<div class="details-header">
									<div class="row">
										<div class="col-md-6">
											<span class="title">#APT00{{$appointment->id}} </span>
											<span class="text">{{$appointment->date_apt}} {{$appointment->begin_time}}</span>
										</div>
										<div class="col-md-6">
											<div class="text-right">
												@if($appointment->status == 0)
												<button type="button" class="btn bg-warning-light btn-sm" id="topup_status">Pending</button>
												@endif
												@if($appointment->status == 1)
												<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Confirmed</button>
												@endif
												@if($appointment->status == 2)
												<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Cancelled</button>
												@endif
												@if($appointment->status == 3)
												<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Completed</button>
												@endif
											</div>
										</div>
									</div>
								</div>
							</li>

							<li>
								<span class="title">Status:</span>
								@if($appointment->status == 0)
								<span class="text">Pending</span>
								@endif
								@if($appointment->status == 1)
								<span class="text">Confirmed</span>
								@endif
								@if($appointment->status == 2)
								<span class="text">Cancelled</span>
								@endif
								@if($appointment->status == 3)
								<span class="text">Completed</span>
								@endif
							</li>

							@if($appointment->confirm_date != '')
							<li>
								<span class="title">Confirm Date:</span>
								<span class="text">{{$appointment->confirm_date}}</span>
							</li>
							@endif
							<li>
								<span class="title">Paid Amount</span>
								<span class="text">${{$appointment->apt_amount}}</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		@endforeach

		<div id="take_appointment" class="modal fade custom-modal" role="dialog">
		    <div class="modal-dialog modal-dialog-centered">
		        <form action="" id="addForm" method="post">
			        <div class="modal-content">

			        	<div class="modal-header ">
							<h5 class="modal-title">Accept Appointment</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

			            <div class="modal-body text-center">
			                {{ csrf_field() }}
			                {{ method_field('POST') }}
			                <!--<img src="{{asset('/assets/assets/img/sent.png')}}" alt="" width="50" height="46">-->
			                <p>Are you sure you want to take this Appointment?</p>
			                
			            </div>
			            <div class="modal-footer text-center"> 
		                	<a href="#" class="btn btn-white" data-dismiss="modal">No,Close</a>
		                    <button type="submit" class="btn bg-success-light">Yes, Take</button>
		                </div>
			        </div>
		    	</form>
		    </div>
		</div>

		<div id="finish_appointment" class="modal fade custom-modal" role="dialog">
		    <div class="modal-dialog modal-dialog-centered">
		        <form action="" id="addForm" method="post">
			        <div class="modal-content">

			        	<div class="modal-header ">
							<h5 class="modal-title">Finish Appointment</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

			            <div class="modal-body text-center">
			                {{ csrf_field() }}
			                {{ method_field('POST') }}
			                <!--<img src="{{asset('/assets/assets/img/sent.png')}}" alt="" width="50" height="46">-->
			                <p>Are you sure to finish this Appointment?</p>
			                
			            </div>
			            <div class="modal-footer text-center"> 
		                	<a href="#" class="btn btn-white" data-dismiss="modal">No,Close</a>
		                    <button type="submit" class="btn bg-danger-light">Yes, Finish</button>
		                </div>
			        </div>
		    	</form>
		    </div>
		</div>


		<div id="cancel_appointment" class="modal fade custom-modal" role="dialog">
		    <div class="modal-dialog modal-dialog-centered">
		        <form action="" id="addForm" method="post">
			        <div class="modal-content">

			        	<div class="modal-header ">
							<h5 class="modal-title">Cancel Appointment</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

			            <div class="modal-body text-center">
			                {{ csrf_field() }}
			                {{ method_field('POST') }}
			                <!--<img src="{{asset('/assets/assets/img/sent.png')}}" alt="" width="50" height="46">-->
			                <p>Are you sure you want to cancel this Appointment?</p>
			                
			            </div>
			            <div class="modal-footer text-center"> 
		                	<a href="#" class="btn btn-white" data-dismiss="modal">No,Close</a>
		                    <button type="submit" class="btn bg-danger-light">Yes, Cancel</button>
		                </div>
			        </div>
		    	</form>
		    </div>
		</div>
      
        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery.min.js') }}"></script>

        <script>
		function addData(id)
	     {
	         var id = id;
	         var url = '{{ route("take", ":id") }}';
	         url = url.replace(':id', id);
	         $("#addForm").attr('action', url);
	     }

	     function formSubmit()
	     {
	         $("#addForm").submit();
	     }
		</script>

		<script>
		function cancelData(id)
	     {
	         var id = id;
	         var url = '{{ route("archivedapt", ":id") }}';
	         url = url.replace(':id', id);
	         $("#addForm").attr('action', url);
	     }

	     function formSubmit()
	     {
	         $("#addForm").submit();
	     }
		</script>

		<script>
		function finishData(id)
	     {
	         var id = id;
	         var url = '{{ route("finish", ":id") }}';
	         url = url.replace(':id', id);
	         $("#addForm").attr('action', url);
	     }

	     function formSubmit()
	     {
	         $("#addForm").submit();
	     }
		</script>
        
        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

        <!-- Circle Progress JS -->
		<script src="{{asset('assets/js/circle-progress.min.js') }}"></script>
        
        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
        
    </body>
</html>