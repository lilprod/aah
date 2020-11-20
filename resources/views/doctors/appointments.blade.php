<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - Appointments</title>
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
									<li class="breadcrumb-item active" aria-current="page">Appointments</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Appointments <span style="color: #26a9e166">+</span></h2>
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
							
        					@include('inc.messages')

							<div class="appointments">
							
							@foreach($myallapts as $i=>$appointment)
								<!-- Appointment List -->
								<div class="appointment-list">
									<div class="profile-info-widget">
										<a href="{{route('patient.profile', $appointment->patient->id)}}" class="booking-doc-img">
											<img src="{{url('/storage/profile_images/'.$appointment->patient->profile_picture ) }}" alt="User Image">
										</a>
										<div class="profile-det-info">
											<h3><a href="{{route('patient.profile', $appointment->patient->id)}}">{{$appointment->patient->name}} {{$appointment->patient->firstname}}</a></h3>
											<div class="patient-details">
												<h5><i class="far fa-clock"></i> {{$appointment->date_apt}}, {{$appointment->begin_time}}</h5>

												@if($appointment->patient->address != '')
													<h5><i class="fas fa-map-marker-alt"></i> {{$appointment->patient->address}}</h5>
												@endif

												@if($appointment->patient->email != '')
													<h5><i class="fas fa-envelope"></i> {{$appointment->patient->email}}</h5>
												@endif	

												@if($appointment->patient->phone_number != '')
													<h5 class="mb-0"><i class="fas fa-phone"></i> {{$appointment->patient->phone_number}}</h5>
												@endif
											</div>
										</div>
									</div>
									<div class="appointment-action">
										<a href="" class="btn btn-sm bg-info-light" data-toggle="modal" data-target="#appt_details{{$i}}">
											<i class="far fa-eye"></i> View
										</a>

										@if(($appointment->paymentmode_id == 1 )|| ($appointment->paymentmode_id == 2))
										<a href="javascript:void(0);" onclick="verifData({{ $appointment->id}})" class="btn btn-sm bg-primary-light">
											<i class="fas fa-binoculars"></i> Check
										</a>
										<form id="verif-form" action="" method="POST" style="display: none;">
                                            @csrf
                                        </form>
										@endif
										<!--{!! '<a href="' . route('appointments.show', $appointment->id) . '" class="btn btn-sm bg-info-light" id="show"><i class="far fa-eye"></i> View</a>' !!}-->

										<!--<a data-toggle="modal" data-target="#details{{$i}}" title="Voire plus de Détails" href="">Détails</a>-->
										@if($appointment->status == 0)
										<a href="javascript:void(0);" class="btn btn-sm bg-success-light" data-toggle="modal" data-target="#take_appointment" onclick="addData({{ $appointment->id}})">
											<i class="fas fa-check"></i> Accept
										</a>
										@endif

										<!--<a href="javascript:void(0);" class="btn btn-sm bg-success-light">
											<i class="fas fa-check"></i> Accept
										</a>-->
									@if($appointment->status == 0)
									<a href="javascript:void(0);" class="btn btn-sm bg-danger-light" data-toggle="modal" data-target="#cancel_appointment" onclick="cancelData({{ $appointment->id}})">
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
								</div>
								<!-- /Appointment List -->
								@endforeach
							
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
		        <form action="" id="finishForm" method="post">
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
		        <form action="" id="cancelForm" method="post">
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
		
		<!-- Appointment Details Modal -->
		<!--<div class="modal fade custom-modal" id="appt_details">-->
		@foreach($myallapts as $i=>$appointment)
		<div class="modal fade custom-modal" id="appt_details{{$i}}">
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
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>

		<script>
			function verifData(id)
		     {
		         var id = id;
		         var url = '{{ route("verif", ":id") }}';
		         url = url.replace(':id', id);
		         $("#verif-form").attr('action', url);
		         $("#verif-form").submit();
		     }

		     function formSubmit()
		     {
		         $("#verif-form").submit();
		     }
		</script>

		<!--<script>
		  $(() => {
		    $('#show').click(e => {
		      let that = e.currentTarget;
		      e.preventDefault();
		      $.ajax({
		        method: $(that).attr('method'),
		        url: $(that).attr('href'),
		        data: $(that).serialize()
		      })
		      .done((data) => {
		        $('#detail').html(data);
		        $('.details').modal('show');
		      })
		      .fail((data) => {
		        console.log(data);
		      });
		    });
		  });
		</script>-->

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
	         $("#cancelForm").attr('action', url);
	     }

	     function formSubmit()
	     {
	         $("#cancelForm").submit();
	     }
		</script>

		<script>
		function finishData(id)
	     {
	         var id = id;
	         var url = '{{ route("finish", ":id") }}';
	         url = url.replace(':id', id);
	         $("#finishForm").attr('action', url);
	     }

	     function formSubmit()
	     {
	         $("#finishForm").submit();
	     }
		</script>
		
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