<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - Patient Profile</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css') }}">
		
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
			@include('website.hearder')
			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Patient Profile <span style="color: #26a9e166">+</span></h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft">
						
							<!-- Profile Widget -->
							<div class="card widget-profile pat-widget-profile">
								<div class="card-body">
									<div class="pro-widget-content">
										<div class="profile-info-widget">
											<a href="#" class="booking-doc-img">
												<img src="{{url('/storage/profile_images/'.$patient->profile_picture ) }}" alt="User Image">
											</a>
											<div class="profile-det-info">
												<h3>{{$patient->name}} {{$patient->firstname}}</h3>
												
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
											<li>Phone <span>{{$patient->name}}</span></li>
											<li>Age 
												<span>@if($patient->birth_date != '') 
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
							<!-- /Profile Widget -->
							
							<!-- Last Booking -->
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Last Booking</h4>
								</div>
								<ul class="list-group list-group-flush">

									@foreach($lastbookings as $lastbooking)
									<li class="list-group-item">
										<div class="media align-items-center">
											<div class="mr-3">
												<img alt="Image placeholder" src="{{url('/storage/profile_images/'.$lastbooking->doctor->profile_picture ) }}" class="avatar  rounded-circle">
											</div>
											<div class="media-body">
												<h5 class="d-block mb-0">Dr. {{$lastbooking->doctor->name }} {{$lastbooking->doctor->firstname}} </h5>
												<span class="d-block text-sm text-muted">{{$lastbooking->doctor->speciality->title}}</span>
												<span class="d-block text-sm text-muted"></i> {{$lastbooking->date_apt}}, {{$lastbooking->begin_time}}</span>
											</div>
										</div>
									</li>
									@endforeach
								</ul>
							</div>
							<!-- /Last Booking -->
							
						</div>

						<div class="col-md-7 col-lg-8 col-xl-9 dct-appoinment">
							<div class="card">
								<div class="card-body pt-0">
									<div class="user-tabs">
										<ul class="nav nav-tabs nav-tabs-bottom nav-justified flex-wrap">
											<li class="nav-item">
												<a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#pres" data-toggle="tab"><span>Prescription</span></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#medical" data-toggle="tab"><span class="med-records">Medical Records</span></a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#billing" data-toggle="tab"><span>Billing</span></a>
											</li> 
										</ul>
									</div>
									<div class="tab-content">
										
										<!-- Appointment Tab -->
										<div id="pat_appointments" class="tab-pane fade show active">
											<div class="card card-table mb-0">
												<div class="card-body">
													<div class="table-responsive">
														<table class="table table-hover table-center mb-0">
															<thead>
																<tr>
																	<th>Doctor</th>
																	<th>Appt Date</th>
																	<th>Booking Date</th>
																	<th>Amount</th>
																	<th>Follow Up</th>
																	<th>Status</th>
																	<th></th>
																</tr>
															</thead>
															<tbody>
																@foreach($bookings as $booking)
																<tr>
																	<td>
																		<h2 class="table-avatar">
																			<a href="{{route('doctor.profile', $booking->doctor->id)}}" class="avatar avatar-sm mr-2">
																				<img class="avatar-img rounded-circle" src="{{url('/storage/profile_images/'.$booking->doctor->profile_picture ) }}" alt="User Image">
																			</a>
																			<a href="{{route('doctor.profile', $booking->doctor->id)}}">Dr. {{$booking->doctor->name }} {{$booking->doctor->firstname}} <span>{{$booking->doctor->speciality->title}}</span></a>
																		</h2>
																	</td>
																	<td>{{$booking->date_apt}} <span class="d-block text-info">{{$booking->begin_time}}</span></td>
																	<td>{{$booking->created_at}}</td>
																	<td>$160</td>
																	<td> - </td>
																	<td>

																		@if($booking->status == 0)
																		<span class="badge badge-pill bg-warning-light">Pending</span>
																		@endif
																		@if($booking->status == 1)
																		<span class="badge badge-pill bg-success-light">Confirmed</span>
																		@endif
																		@if($booking->status == 2)
																		<span class="badge badge-pill bg-danger-light">Cancelled</span>
																		@endif
																		@if($booking->status == 3)
																		<span class="badge badge-pill bg-primary-light">Completed</span>
																		@endif
																	</td>
																	<td class="text-right">
																		<div class="table-action">
																			<a href="javascript:void(0);" class="btn btn-sm bg-success-light">
																				<i class="far fa-edit"></i> Edit
																			</a>
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
										<!-- /Appointment Tab -->
										
										<!-- Prescription Tab -->
										<div class="tab-pane fade" id="pres">
											<div class="text-right">
												<a href="#" class="add-new-btn">Add Prescription</a>
											</div>
											<div class="card card-table mb-0">
												<div class="card-body">
													<div class="table-responsive">
														<table class="table table-hover table-center mb-0">
															<thead>
																<tr>
																	<th>Date </th>
																	<th>Name</th>									
																	<th>Created by </th>
																	<th></th>
																</tr>     
															</thead>
															<tbody>

																@foreach($prescriptions as $prescription)
																<tr>
																	<td>{{$prescription->created_at->format('d/m/Y')}}</td>
																	<td>Prescription</td>
																	<td>
																		<h2 class="table-avatar">
																			<a href="{{route('doctor.profile', $prescription->doctor->id)}}" class="avatar avatar-sm mr-2">
																				<img class="avatar-img rounded-circle" src="{{url('/storage/profile_images/'.$prescription->doctor->profile_picture ) }}" alt="User Image">
																			</a>
																			<a href="{{route('doctor.profile', $prescription->doctor->id)}}">Dr. {{$prescription->doctor->name }} {{$prescription->doctor->firstname}} <span>{{$prescription->doctor->speciality->title}}</span></a>
																		</h2>
																	</td>
																	<td class="text-right">
																		<div class="table-action">
																			<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																				<i class="fas fa-print"></i> Print
																			</a>
																			<a href="{{route('prescriptions.show', $prescription->id)}}" class="btn btn-sm bg-info-light">
																				<i class="far fa-eye"></i> View
																			</a>
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
										<!-- /Prescription Tab -->

										<!-- Medical Records Tab -->
										<div class="tab-pane fade" id="medical">
											<div class="text-right">		
												<a href="#" class="add-new-btn" data-toggle="modal" data-target="#add_medical_records">Add Medical Records</a>
											</div>
											<div class="card card-table mb-0">
												<div class="card-body">
													<div class="table-responsive">
														<table class="table table-hover table-center mb-0">
															<thead>
																<tr>
																	<th>ID</th>
																	<th>Date </th>
																	<th>Description</th>
																	<th>Attachment</th>
																	<th>Created</th>
																	<th></th>
																</tr>     
															</thead>
															<tbody>
																<tr>
																	<td><a href="javascript:void(0);">#MR-0010</a></td>
																	<td>14 Nov 2019</td>
																	<td>Dental Filling</td>
																	<td><a href="#">dental-test.pdf</a></td>
																	<td>
																		<h2 class="table-avatar">
																			<a href="doctor-profile.html" class="avatar avatar-sm mr-2">
																				<img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-01.jpg" alt="User Image">
																			</a>
																			<a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
																		</h2>
																	</td>
																	<td class="text-right">
																		<div class="table-action">
																			<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																				<i class="fas fa-print"></i> Print
																			</a>
																			<a href="javascript:void(0);" class="btn btn-sm bg-info-light">
																				<i class="far fa-eye"></i> View
																			</a>
																		</div>
																	</td>
																</tr>
																
															</tbody>  	
														</table>
													</div>
												</div>
											</div>
										</div>
										<!-- /Medical Records Tab -->
										
										<!-- Billing Tab -->
										<div class="tab-pane" id="billing">
											<div class="text-right">
												<a class="add-new-btn" href="#">Add Billing</a>
											</div>
											<div class="card card-table mb-0">
												<div class="card-body">
													<div class="table-responsive">
													
														<table class="table table-hover table-center mb-0">
															<thead>
																<tr>
																	<th>Invoice No</th>
																	<th>Doctor</th>
																	<th>Amount</th>
																	<th>Paid On</th>
																	<th></th>
																</tr>
															</thead>
															<tbody>
																@foreach($payments as $payment)
																<tr>
																	<td>
																		<a href="invoice-view.html">#INV-00{{$payment->id}}</a>
																	</td>
																	<td>
																		<h2 class="table-avatar">
																			<a href="{{route('doctor.profile', $payment->doctor->id)}}" class="avatar avatar-sm mr-2">
																				<img class="avatar-img rounded-circle" src="{{url('/storage/profile_images/'.$payment->doctor->profile_picture ) }}" alt="User Image">
																			</a>
																			<a href="{{route('doctor.profile', $payment->doctor->id)}}">Dr. {{$payment->doctor->name }} {{$payment->doctor->firstname}}  <span>{{$payment->doctor->speciality->title}}</span></a>
																		</h2>
																	</td>
																	<td>${{$payment->apt_amount}}</td>
																	<td>{{$payment->created_at->format('d/m/Y')}}</td>
																	<td class="text-right">
																		<div class="table-action">
																			<a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
																				<i class="fas fa-print"></i> Print
																			</a>
																			<a href="{{route('invoice.show', $payment->id)}}" class="btn btn-sm bg-info-light">
																				<i class="far fa-eye"></i> View
																			</a>
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
										<!-- Billing Tab -->
												
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
		
		<!-- Add Medical Records Modal -->
		<div class="modal fade custom-modal" id="add_medical_records">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title">Medical Records</h3>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<form>					
						<div class="modal-body">
							<div class="form-group">
								<label>Date</label>
								<input type="text" class="form-control datetimepicker" value="31-10-2019">
							</div>
							<div class="form-group">
								<label>Description ( Optional )</label>
								<textarea class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label>Upload File</label> 
								<input type="file" class="form-control">
							</div>	
							<div class="submit-section text-center">
								<button type="submit" class="btn btn-primary submit-btn">Submit</button>
								<button type="button" class="btn btn-secondary submit-btn" data-dismiss="modal">Cancel</button>							
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Add Medical Records Modal -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Datetimepicker JS -->
		<script src="{{asset('assets/js/moment.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>