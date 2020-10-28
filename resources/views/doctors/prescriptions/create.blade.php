<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - Add Prescription</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
        
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">

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
									<li class="breadcrumb-item active" aria-current="page">Add Prescription</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Add Prescription</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
						
							<!-- Profile Widget -->
							<div class="card widget-profile pat-widget-profile">
								<div class="card-body">
									<div class="pro-widget-content">
										<div class="profile-info-widget">
											<a href="{{route('patient.profile', $appointment->patient->id)}}" class="booking-doc-img">
												<img src="{{url('/storage/profile_images/'.$appointment->patient->profile_picture ) }}" alt="User Image">
											</a>
											<div class="profile-det-info">
												<h3><a href="{{route('patient.profile', $appointment->patient->id)}}">{{$appointment->patient->name}} {{$appointment->patient->firstname}}</a></h3>
												<div class="patient-details">
													<h5><b>Patient ID :</b> PT00{{$appointment->patient->id}}</h5>
													@if($appointment->patient->address != '')
													<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{$appointment->patient->address}}</h5>
													@endif
												</div>
											</div>
										</div>
									</div>
									<div class="patient-info">
										<ul>
											@if($appointment->patient->phone_number != '')
											<li>Phone <span>{{$appointment->patient->phone_number}}</span></li>
											@endif

											@if($appointment->patient->birth_date != '')
											<li>Age <span>38 Years, Male</span></li>
											@endif

											@if($appointment->patient->blood_group != '' && $appointment->patient->rhesus != '')
											<li>Blood Group <span>{{$appointment->patient->blood_group}}{{$appointment->patient->rhesus}}</span></li>
											@endif
										</ul>
									</div>
								</div>
							</div>
							<!-- /Profile Widget -->
							
						</div>

						<div class="col-md-7 col-lg-8 col-xl-9">

							<div class="row">
			                    <div class="col-md-12">
			                        @include('inc.messages')
			                    </div>
			                </div>


							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0">Add Prescription</h4>
								</div>

								<form method="POST" action="{{ route('prescriptions.store') }}" enctype="multipart/form-data">
        						@csrf


								<div class="card-body">

									<input class="form-control" type="hidden" value="{{$appointment->id}}" name="appointment_id">

									<input class="form-control" type="hidden" value="{{$appointment->patient_id}}" name="patient_id">

									<input class="form-control" type="hidden" value="{{$appointment->doctor_id}}" name="doctor_id">

									<div class="row">
										<div class="col-sm-6">
											<div class="biller-info">
												<h4 class="d-block">Dr. {{$appointment->doctor->name}} {{$appointment->doctor->firstname}}</h4>

												@if($appointment->doctor->speciality_id != '')
												<span class="d-block text-sm text-muted">{{$appointment->doctor->speciality->title}}</span>
												@endif

												@if($appointment->doctor->address != '')
												<span class="d-block text-sm text-muted">{{$appointment->doctor->address}}</span>
												@endif
											</div>
										</div>
										<div class="col-sm-6 text-sm-right">
											<div class="billing-info">
												<h4 class="d-block">1 November 2019</h4>
												<span class="d-block text-muted">#INV0001</span>
											</div>
										</div>
									</div>


									
									<div class="row form-row">
					                    <div class="col-12 col-sm-6">
					                        <div class="form-group">
					                        	<label>Chief Complains</label>
					                            <textarea required="required" id="cc" rows="3" class="form-control" name="chief_complains"></textarea>
					                        </div>
					                    </div>

					                    <div class="col-12 col-sm-6">

					                        <div class="form-group">
					                        	<label>On examinations</label>
					                            <textarea required="required" id="oe" rows="3" class="form-control" name="on_examinations"></textarea>
					                         </div>
					                     </div>

					                     <div class="col-12 col-sm-6">
					                        <div class="form-group">
					                        	<label>Provisional Diagnosis</label>
					                            <textarea required="required" id="pd" rows="3" class="form-control" name="provisional_diagnosis"></textarea>
					                        </div>
					                    </div>

					                      <div class="col-12 col-sm-6">
					                      	<div class="form-group">
					                        	<label>Differential diagnosis</label>
					                            <textarea required="required" id="dd" rows="3" class="form-control" name="differential_diagnosis"></textarea>
					                        </div>
					                    </div>

					                    <div class="col-12 col-sm-6">
					                        <div class="form-group">
					                        	<label>Lab Workup</label>
					                            <textarea required="required" id="lab_worekup" rows="3" class="form-control" name="lab_workup"></textarea>
					                        </div>

					                    </div>

					                        <div class="col-12 col-sm-6">
						                        <div class="form-group">
						                        	<label>Advices</label>
						                            <textarea id="advices" required="required" class="form-control" rows="3" name="advices"></textarea>
						                        </div>
						                    </div>

					                </div>
									<!-- Add Item -->
									<div class="add-more-item text-right">
										<a href="javascript:void(0);" id="add"><i class="fas fa-plus-circle"> </i> Add Item</a>
									</div>
									<!-- /Add Item -->
									
									<!-- Prescription Item -->
									<div class="card card-table">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-center" id="dynamic_field">
													<thead>
														<tr>
															<th style="min-width: 200px">Name</th>
															<th style="min-width: 60px;">Quantity</th>
															<th style="min-width: 60px;">Dosage</th>
															<th style="min-width: 60px">Days</th>
															<th style="min-width: 100px;">Time</th>
															<th style="min-width: 60px;"></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<div class="form-group">
																	<select class="select form-control" name="drug_id[]">@foreach ($drugs as $drug)
																		<option value="{{ $drug->id }}">{{ $drug->name }}</option>
																	@endforeach
																	</select>
																</div>
															</td>

															<td>
																<div class="form-group">
																	<input class="form-control" type="text" name="quantity[]">
																</div>
															</td>

															<td>
																<div class="form-group">
																	<input class="form-control" type="text" name="strength[]">
																</div>
															</td>

															<td>
																<div class="form-group">
																	<input class="form-control" type="text" name="duration[]">
																</div>
															</td>

															<td>
																<div class="form-group">
																<div class="form-check form-check-inline">
																	<label class="form-check-label">
																		<input class="form-check-input" type="checkbox" onclick="$(this).attr('value', this.checked ? 1 : 0)" name="morning[]" value="0"> Morning
																	</label>
																</div>
																<div class="form-check form-check-inline">
																	<label class="form-check-label">
																		<input class="form-check-input" type="checkbox" onclick="$(this).attr('value', this.checked ? 1 : 0)" name="afternoon[]" value="0"> Afternoon
																	</label>
																</div>
																<div class="form-check form-check-inline">
																	<label class="form-check-label">
																		<input class="form-check-input" type="checkbox" onclick="$(this).attr('value', this.checked ? 1 : 0)" name="evening[]" value="0"> Evening
																	</label>
																</div>
																<div class="form-check form-check-inline">
																	<label class="form-check-label">
																		<input class="form-check-input" type="checkbox" onclick="$(this).attr('value', this.checked ? 1 : 0)" name="night[]" value="0"> Night
																	</label>
																</div>
															</div>

															</td>
															<td>
																<div class="form-group">
																	<a href="#" class="btn bg-danger-light trash btn_remove" id="0" name="remove"><i class="far fa-trash-alt"></i></a>
																</div>
																
															</td>
														</tr>

														<!--<tr>
															<td colspan="6">
																<div class="form-group">
										                        	<label>Advice</label>
										                            <textarea id="advice" class="form-control" rows="3" name="advice[]"></textarea>
										                        </div>
															</td>
														</tr>-->
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<!-- /Prescription Item -->

									<div class="row">
										<div class="col-md-6">
					                        <div class="form-group">
					                        	<label>Next Visit</label>
					                            <input id="next_visit" type="date" required="required" class="form-control" name="next_visit">
					                        </div>
										</div>
									</div>
									<!-- Signature -->
									<div class="row">
										<div class="col-md-12 text-right">
											<div class="signature-wrap">
												<div class="signature">
													<!--Click here to sign-->
												</div>
												<div class="sign-name">
													<p class="mb-0">( Dr. {{$appointment->doctor->name}} {{$appointment->doctor->firstname}} )</p>
													<span class="text-muted">Signature</span>
												</div>
											</div>
										</div>
									</div>
									<!-- /Signature -->
									
									<!-- Submit Section -->
									<div class="row">
										<div class="col-md-12">
											<div class="submit-section">
												<button type="submit" class="btn btn-primary submit-btn">Save</button>
												<button type="reset" class="btn btn-secondary submit-btn">Clear</button>
											</div>
										</div>
									</div>
									<!-- /Submit Section -->
									
								</div>

							</form>
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

		<script>
    	$(document).ready(function(){ 

    		var i=1;  
		      $('#add').click(function(){  
		           i++;  
		           console.log('ok');
		           $('#dynamic_field').append('<tr id="row'+i+'"><td><div class="form-group"><select class="select form-control" name="drug_id[]">@foreach ($drugs as $drug)<option value="{{ $drug->id }}">{{ $drug->name }}</option>@endforeach</select></div></td><td><div class="form-group"><input class="form-control" type="text" name="quantity[]" required></div></td><td><div class="form-group"><input class="form-control" type="text" name="strength[]"></div></td><td><div class="form-group"><input class="form-control" type="text" name="duration[]"></div></td><td><div class="form-group"><div class="form-check form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="morning[]" onclick="$(this).val(this.checked ? 1 : 0)"> Morning</label></div><div class="form-check form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="afternoon[]" onclick="$(this).val(this.checked ? 1 : 0)"> Afternoon</label></div><div class="form-check form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="evening[]" onclick="$(this).val(this.checked ? 1 : 0)"> Evening</label></div><div class="form-check form-check-inline"><label class="form-check-label"><input class="form-check-input" type="checkbox" name="night[]" onclick="$(this).val(this.checked ? 1 : 0)"> Night</label></div></div></td><td><div class="form-group"><a href="#" class="btn bg-danger-light trash btn_remove" id="'+i+'" name="remove"><i class="far fa-trash-alt"></i></a></div></td></tr>'
		           	); 
		      }); 



    		$(document).on('click', '.btn_remove', function(){  
           		var button_id = $(this).attr("id");   
           		$('#row'+button_id+'').remove();

           	}); 
    	}); 

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