<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - Schedule Timing</title>
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
									<li class="breadcrumb-item active" aria-current="page">Schedule Timings</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Schedule Timings <span style="color: #26a9e166">+</span></h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						
						<!-- Profile Sidebar -->
						@include('doctors.partials.profile_side')
						<!-- /Profile Sidebar -->
						
						<div class="col-md-7 col-lg-8 col-xl-9">
						 	@include('inc.messages')

							<div class="row">
								<div class="col-sm-12">
									<div class="card">
										<div class="card-body">
											<h4 class="card-title">Schedule Timings</h4>
											<div class="profile-box">
												<div class="row">

													<!--<div class="col-lg-4">
														<div class="form-group">               
															<label>Timing Slot Duration</label>
															<select class="select form-control">
																<option>-</option>
																<option>15 mins</option>
																<option selected="selected">30 mins</option>  
																<option>45 mins</option>
																<option>1 Hour</option>
															</select>
														</div>
													</div>-->

												</div>     
												<div class="row">
													<div class="col-md-12">
														<div class="card schedule-widget mb-0">
														
															<!-- Schedule Header -->
															<div class="schedule-header">
															
																<!-- Schedule Nav -->
																<div class="schedule-nav">
																	<ul class="nav nav-tabs nav-justified">
																		<li class="nav-item">
																			<a class="nav-link" data-toggle="tab" href="#slot_sunday">Sunday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link active" data-toggle="tab" href="#slot_monday">Monday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-toggle="tab" href="#slot_tuesday">Tuesday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-toggle="tab" href="#slot_wednesday">Wednesday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-toggle="tab" href="#slot_thursday">Thursday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-toggle="tab" href="#slot_friday">Friday</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-toggle="tab" href="#slot_saturday">Saturday</a>
																		</li>
																	</ul>
																</div>
																<!-- /Schedule Nav -->
																
															</div>
															<!-- /Schedule Header -->
															
															<!-- Schedule Content -->
															<div class="tab-content schedule-cont">
															
																<!-- Sunday Slot -->
																<div id="slot_sunday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		@if(count($schedulesSunday)>0)
																		<a class="edit-link" data-toggle="modal" href="#edit_time_slot" data-attr="{{ route('schedules.edit', 7) }}" id="edit_time7"><i class="fa fa-edit mr-1"></i>Edit</a>
																		@else
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot" data-id="7" id="add_time7"><i class="fa fa-plus-circle"></i> Add Slot</a>
																		@endif

																	</h4>
																		@if(count($schedulesSunday)>0)
																			<div class="doc-times">
																				@foreach ($schedulesSunday as $schedule7)
																				<div class="doc-slot-list">
																					{{$schedule7->begin_time}} - {{$schedule7->begin_time}}
																					<a href="javascript:void(0)" class="delete_schedule" data-toggle="modal" data-target="#delete_time_slot" onclick="deleteData({{ $schedule7->id}})">
																						<i class="fa fa-times"></i>
																					</a>
																				</div>
																				@endforeach
																			</div>
																		@else
																		<p class="text-muted mb-0">Not Available</p>
																		@endif
																</div>
																<!-- /Sunday Slot -->

																<!-- Monday Slot -->
																<div id="slot_monday" class="tab-pane fade show active">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		@if(count($schedulesMonday)>0)
																		<a class="edit-link" data-toggle="modal" href="#edit_time_slot" data-attr="{{ route('schedules.edit', 1) }}" id="edit_time1"><i class="fa fa-edit mr-1"></i>Edit</a>

																		@else
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot" data-id="1" id="add_time1"><i class="fa fa-plus-circle"></i> Add Slot</a>
																		@endif
																	</h4>
																	
																	<!-- Slot List -->
																	@if(count($schedulesMonday)>0)
																	<div class="doc-times">
																		@foreach ($schedulesMonday as $schedule1)
																			<div class="doc-slot-list">
																				{{$schedule1->begin_time}} - {{$schedule1->end_time}}
																				<a href="javascript:void(0)" class="delete_schedule" data-toggle="modal" data-target="#delete_time_slot" onclick="deleteData({{ $schedule1->id}})">
																					<i class="fa fa-times"></i>
																				</a>
																			</div>
																		@endforeach
																	</div>
																	@else
																	<p class="text-muted mb-0">Not Available</p>
																	@endif
																	<!-- /Slot List -->
																	
																</div>
																<!-- /Monday Slot -->

																<!-- Tuesday Slot -->
																<div id="slot_tuesday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		@if(count($schedulesTuesday)>0)
																		<a class="edit-link" data-toggle="modal" href="#edit_time_slot" data-attr="{{ route('schedules.edit', 2) }}" id="edit_time2"><i class="fa fa-edit mr-1"></i>Edit</a>
																		@else
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot" data-id="2" id="add_time2"><i class="fa fa-plus-circle"></i> Add Slot</a>
																		@endif
																	</h4>
																	<!-- Slot List -->
																	
																		@if (count($schedulesTuesday)>0)
																		<div class="doc-times">
																			@foreach($schedulesTuesday as $schedule2)
																			<div class="doc-slot-list">
																				{{$schedule2->begin_time}} - {{$schedule2->end_time}}
																				<a href="javascript:void(0)" class="delete_schedule" data-toggle="modal" data-target="#delete_time_slot" onclick="deleteData({{ $schedule2->id}})">
																					<i class="fa fa-times"></i>
																				</a>
																			</div>
																			@endforeach
																		</div>
																		@else	
																		<p class="text-muted mb-0">Not Available</p>
																		@endif
																	<!-- /Slot List -->
																</div>
																<!-- /Tuesday Slot -->

																<!-- Wednesday Slot -->
																<div id="slot_wednesday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		@if(count($schedulesWednesday)>0)
																		<a class="edit-link" data-toggle="modal" href="#edit_time_slot" data-attr="{{ route('schedules.edit', 3) }}" id="edit_time3"><i class="fa fa-edit mr-1"></i>Edit</a>
																		@else
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot" data-id="3" id="add_time3"><i class="fa fa-plus-circle"></i> Add Slot</a>
																		@endif
																	</h4>
																	<!-- Slot List -->
																	@if (count($schedulesWednesday)>0)
																	<div class="doc-times">
																		@foreach ($schedulesWednesday as $schedule3)
																		
																			<div class="doc-slot-list">
																				{{$schedule3->begin_time}} - {{$schedule3->end_time}}
																				<a href="javascript:void(0)" class="delete_schedule" data-toggle="modal" data-target="#delete_time_slot" onclick="deleteData({{ $schedule3->id}})">
																					<i class="fa fa-times"></i>
																				</a>
																			</div>
																		@endforeach
																	</div>
																	@else
																	<p class="text-muted mb-0">Not Available</p>
																	@endif
																	<!-- /Slot List -->
																</div>
																<!-- /Wednesday Slot -->

																<!-- Thursday Slot -->
																<div id="slot_thursday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		@if(count($schedulesThursday)>0)
																		<a class="edit-link" data-toggle="modal" href="#edit_time_slot" data-attr="{{ route('schedules.edit', 4) }}" id="edit_time4"><i class="fa fa-edit mr-1"></i>Edit</a>
																		@else
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot" data-id="4" id="add_time4"><i class="fa fa-plus-circle"></i> Add Slot</a>
																		@endif
																	</h4>
																	<!-- Slot List -->
																	@if (count($schedulesThursday)>0)
																	<div class="doc-times">
																		@foreach($schedulesThursday as $schedule4)
																		
																			<div class="doc-slot-list">
																				{{$schedule4->begin_time}} - {{$schedule4->end_time}}
																				<a href="javascript:void(0)" class="delete_schedule" data-toggle="modal" data-target="#delete_time_slot" onclick="deleteData({{ $schedule4->id}})">
																					<i class="fa fa-times"></i>
																				</a>
																			</div>
																		@endforeach
																	</div>
																	@else
																	<p class="text-muted mb-0">Not Available</p>
																	@endif
																	<!-- /Slot List -->
																</div>
																<!-- /Thursday Slot -->

																<!-- Friday Slot -->
																<div id="slot_friday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		@if(count($schedulesFriday)>0)
																		<a class="edit-link" data-toggle="modal" href="#edit_time_slot" data-attr="{{ route('schedules.edit', 5) }}" id="edit_time5"><i class="fa fa-edit mr-1"></i>Edit</a>
																		@else
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot" data-id="5" id="add_time5"><i class="fa fa-plus-circle"></i> Add Slot</a>
																		@endif
																	</h4>
																	<!-- Slot List -->
																	@if (count($schedulesFriday)>0)
																	<div class="doc-times">
																		@foreach($schedulesFriday as $schedule5)
																		
																			<div class="doc-slot-list">
																				{{$schedule5->begin_time}} - {{$schedule5->end_time}}
																				<a href="javascript:void(0)" class="delete_schedule" data-toggle="modal" data-target="#delete_time_slot" onclick="deleteData({{ $schedule5->id}})">
																					<i class="fa fa-times"></i>
																				</a>
																			</div>
																		@endforeach
																	</div>
																	@else
																	<p class="text-muted mb-0">Not Available</p>
																	@endforelse
																	<!-- /Slot List -->
																</div>
																<!-- /Friday Slot -->

																<!-- Saturday Slot -->
																<div id="slot_saturday" class="tab-pane fade">
																	<h4 class="card-title d-flex justify-content-between">
																		<span>Time Slots</span> 
																		@if(count($schedulesSaturday)>0)
																		<a class="edit-link" data-toggle="modal" href="#edit_time_slot" data-attr="{{ route('schedules.edit', 6) }}" id="edit_time6"><i class="fa fa-edit mr-1"></i>Edit</a>
																		@else
																		<a class="edit-link" data-toggle="modal" href="#add_time_slot" data-id="6" id="add_time6"><i class="fa fa-plus-circle"></i> Add Slot</a>
																		@endif
																	</h4>
																	<!-- Slot List -->
																	@if (count($schedulesSaturday)>0)
																	<div class="doc-times">
																		@foreach($schedulesSaturday as $schedule6)
																		
																			<div class="doc-slot-list">
																				{{$schedule6->begin_time}} - {{$schedule6->end_time}}
																				<a href="javascript:void(0)" class="delete_schedule" data-toggle="modal" data-target="#delete_time_slot" onclick="deleteData({{ $schedule6->id}})">
																					<i class="fa fa-times"></i>
																				</a>
																			</div>
																		@endforeach
																	</div>
																	@else
																	<p class="text-muted mb-0">Not Available</p>
																	@endif
																	<!-- /Slot List -->
																</div>
																<!-- /Saturday Slot -->

															</div>
															<!-- /Schedule Content -->
															
														</div>
													</div>
												</div>
											</div>
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

		<!-- Add Time Slot Modal -->
		<div class="modal fade custom-modal" id="add_time_slot" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add Time Slots</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" action="{{route('bulk_schedules_store')}}">
        					{{csrf_field()}}

							<div class="hours-info">
								<div class="row form-row hours-cont">

									<input type="hidden" class="form-control" name="day_num" id="day_num">

									<div class="col-12 col-md-10">
										<div class="row form-row">
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Start Time</label>
													<select class="form-control" name="begin_time[]" id="begin_time" required>
														<option value = "">-</option>
														<option value = "07:00">07:00</option>
							                            <option value="08:00">08:00</option>
							                            <option value = "09:00">09:00</option>
							                            <option value = "10:00">10:00</option>
							                            <option value = "11:00">11:00</option>
							                            <option value = "14:00">14:00</option>
							                            <option value = "15:00">15:00</option>
							                            <option value = "16:00">16:00</option>
													</select>
												</div> 
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>End Time</label>
													<select class="form-control" name="end_time[]" id="end_time" required>
														<option value = "">-</option>
														<option value="07:30">07:30</option>
							                            <option value="08:30">08:30</option>
							                            <option value="09:30">09:30</option>
							                            <option value="10:30">10:30</option>
							                            <option value="11:30">11:30</option>
							                            <option value="14:30">14:30</option>
							                            <option value="15:30">15:30</option>
							                            <option value="16:30">16:30</option>
														</select>
												</div> 
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="add-more mb-3">
								<a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
							</div>
							<div class="submit-section text-center">
								<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- /Add Time Slot Modal -->

		<!-- Delete Time Slot Modal -->
		<div id="delete_time_slot" class="modal fade custom-modal" role="dialog">
		    <div class="modal-dialog modal-dialog-centered">
		        <form action="" id="deleteForm" method="post">
			        <div class="modal-content">

			        	<div class="modal-header ">
							<h5 class="modal-title">Delete Time Slot</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>

			            <div class="modal-body text-center">
			                {{ csrf_field() }}
			                {{ method_field('DELETE') }}
			                <!--<img src="{{asset('/assets/assets/img/sent.png')}}" alt="" width="50" height="46">-->
			                <p>Are you sure you want to cancel this Time Slot?</p>
			                
			            </div>
			            <div class="modal-footer text-center"> 
		                	<a href="#" class="btn btn-white" data-dismiss="modal">No,Close</a>
		                    <button type="submit" class="btn bg-danger-light">Yes, Cancel</button>
		                </div>
			        </div>
		    	</form>
		    </div>
		</div>
		<!-- Delete Time Slot Modal -->
		
		
		
		<!-- Edit Time Slot Modal -->
		<div class="modal fade custom-modal" id="edit_time_slot">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Time Slots</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="edit_time_body">
						<!-- the result to be displayed apply here -->
					</div>
				</div>
			</div>
		</div>
		<!-- /Edit Time Slot Modal -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>

		<script>

			
			$("#edit_time1").click(function (event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
	                url: href,
	                // return the result
	                success: function(result) {
	                    $('#edit_time_slot').modal("show");
	                    $('#edit_time_body').html(result).show();
	                },
	                
	                error: function(jqXHR, testStatus, error) {
	                    console.log(error);
	                    alert("Page " + href + " cannot open. Error:" + error);
	                },
	                timeout: 8000
            	})
        	});

        	$("#edit_time2").click(function (event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
	                url: href,
	                // return the result
	                success: function(result) {
	                    $('#edit_time_slot').modal("show");
	                    $('#edit_time_body').html(result).show();
	                },
	                
	                error: function(jqXHR, testStatus, error) {
	                    console.log(error);
	                    alert("Page " + href + " cannot open. Error:" + error);
	                },
	                timeout: 8000
            	})
        	});

        	$("#edit_time3").click(function (event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
	                url: href,
	                // return the result
	                success: function(result) {
	                    $('#edit_time_slot').modal("show");
	                    $('#edit_time_body').html(result).show();
	                },
	                
	                error: function(jqXHR, testStatus, error) {
	                    console.log(error);
	                    alert("Page " + href + " cannot open. Error:" + error);
	                },
	                timeout: 8000
            	})
        	});

        	$("#edit_time4").click(function (event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
	                url: href,
	                // return the result
	                success: function(result) {
	                    $('#edit_time_slot').modal("show");
	                    $('#edit_time_body').html(result).show();
	                },
	                
	                error: function(jqXHR, testStatus, error) {
	                    console.log(error);
	                    alert("Page " + href + " cannot open. Error:" + error);
	                },
	                timeout: 8000
            	})
        	});

        	$("#edit_time5").click(function (event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
	                url: href,
	                // return the result
	                success: function(result) {
	                    $('#edit_time_slot').modal("show");
	                    $('#edit_time_body').html(result).show();
	                },
	                
	                error: function(jqXHR, testStatus, error) {
	                    console.log(error);
	                    alert("Page " + href + " cannot open. Error:" + error);
	                },
	                timeout: 8000
            	})
        	});

        	$("#edit_time6").click(function (event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
	                url: href,
	                // return the result
	                success: function(result) {
	                    $('#edit_time_slot').modal("show");
	                    $('#edit_time_body').html(result).show();
	                },
	                
	                error: function(jqXHR, testStatus, error) {
	                    console.log(error);
	                    alert("Page " + href + " cannot open. Error:" + error);
	                },
	                timeout: 8000
            	})
        	});

        	$("#edit_time7").click(function (event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
	                url: href,
	                // return the result
	                success: function(result) {
	                    $('#edit_time_slot').modal("show");
	                    $('#edit_time_body').html(result).show();
	                },
	                
	                error: function(jqXHR, testStatus, error) {
	                    console.log(error);
	                    alert("Page " + href + " cannot open. Error:" + error);
	                },
	                timeout: 8000
            	})
        	});

			/*$("#begin_time").change(function(){          
			    var value = $("#begin_time option:selected").val();

			    $("#begin_time option:selected").attr('disabled','disabled');
			});*/

		    $("#add_time1").click(function () {
		     var day_num = $(this).attr('data-id');
		     $("#add_time_slot #day_num").val( day_num );
		    });

		    $("#add_time2").click(function () {
		     var day_num = $(this).attr('data-id');
		     $("#add_time_slot #day_num").val( day_num );
		    });

		    $("#add_time3").click(function () {
		     var day_num = $(this).attr('data-id');
		     $("#add_time_slot #day_num").val( day_num );
		    });

		    $("#add_time4").click(function () {
		     var day_num = $(this).attr('data-id');
		     $("#add_time_slot #day_num").val( day_num );
		    });

		    $("#add_time5").click(function () {
		     var day_num = $(this).attr('data-id');
		     $("#add_time_slot #day_num").val( day_num );
		    });

		    $("#add_time6").click(function () {
		     var day_num = $(this).attr('data-id');
		     $("#add_time_slot #day_num").val( day_num );
		    });

		    $("#add_time7").click(function () {
		     var day_num = $(this).attr('data-id');
		     $("#add_time_slot #day_num").val( day_num );
		    });
		 </script>

		<script>

		function deleteData(id)
	     {
	         var id = id;
	         var url = '{{ route("schedules.destroy", ":id") }}';
	         url = url.replace(':id', id);
	         $("#deleteForm").attr('action', url);
	     }

	     function formSubmit()
	     {
	         $("#deleteForm").submit();
	     }
		</script>
		
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