<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AAH+ - Profile Settings</title>
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
            @include('patients.partials.header')
      <!-- /Header -->  
	<!-- Breadcrumb -->
	<div class="breadcrumb-bar">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-md-12 col-12">
					<nav aria-label="breadcrumb" class="page-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
						</ol>
					</nav>
					<h2 class="breadcrumb-title">Profile Settings  <span style="color: #26a9e166">+</span></h2>
				</div>
			</div>
		</div>
	</div>
	<!-- /Breadcrumb -->.

	<!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                @include('patients.partials.profile_side')

						<div class="col-md-7 col-lg-8 col-xl-9">
							@include('inc.messages')
							<div class="card">
								<div class="card-body">
									<!-- Profile Settings Form -->
									<form method="POST" action="{{route('post_patient_setting')}}" enctype="multipart/form-data">
										{{ csrf_field() }}
										<input type="hidden" class="form-control" name="patient_id" value="{{$patient->id}}">
										<div class="row form-row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<div class="change-avatar">
														<div class="profile-img">
															@if($patient->profile_picture == '')
															<img src="{{asset('assets/img/patients/patient.jpg') }}" alt="" id="blah">
															@else
															<img src="{{url('/storage/profile_images/'.$patient->profile_picture ) }}" alt="" id="blah">
															@endif
														</div>
														<div class="upload-img">
															<div class="change-photo-btn">
																<span><i class="fa fa-upload"></i> Upload Photo</span>
																<input type="file" class="upload" id="imgInp" name="profile_picture">
															</div>
															<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>First Name</label>
													<input type="text" class="form-control" value="{{$patient->name}}" name="name">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Last Name</label>
													<input type="text" class="form-control" value="{{$patient->firstname}}" name="firstname">
												</div>
											</div>

											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Birth Place</label>
													<input type="text" class="form-control" value="{{$patient->place_birth}}" name="place_birth">
												</div>
											</div>

											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Date of Birth</label>
													<!--<div class="cal-icon"></div>-->
														<input type="date" class="form-control" value="{{$patient->birth_date}}" name="birth_date">
													
												</div>
											</div>

											<div class="col-12 col-md-6">
							                    <div class="form-group">
							                        <label>Marital Status</label>
							                        <select class="form-control select" name="marital_status">
							                            <option value="Célibataire" {{ ($patient->marital_status === 'Célibataire') ? 'selected' : '' }}>Célibataire</option>
							                            <option value="Marié(e)" {{ ($patient->marital_status === 'Marié(e)') ? 'selected' : '' }}>Marié(e)</option>
							                            <option value="Veuf(ve)" {{ ($patient->marital_status === 'Veuf(ve)') ? 'selected' : '' }}>Veuf(ve)</option>
							                            <option value="Divorcé(e)" {{ ($patient->marital_status === 'Divorcé(e)') ? 'selected' : '' }}>Divorcé(e)</option>
							                        </select>
							                    </div>
							                </div>

											<div class="col-12 col-md-6">
												<label class="">Gender</label>
												<div class="form-group">
													<div class="form-check-inline">
														<label class="form-check-label">
															<input type="radio" name="gender" value="M" class="form-check-input" {{  $patient->gender == "M" ? 'checked' : '' }}>Male
														</label>
													</div>
													<div class="form-check-inline">
														<label class="form-check-label">
															<input type="radio" name="gender" value="F" class="form-check-input" {{  $patient->gender == "F" ? 'checked' : '' }}>Female
														</label>
													</div>
												</div>
							                </div>

											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Blood Group</label>
													<select class="form-control select" name="blood_group">
														<option value="A" {{ ($patient->blood_group === 'A') ? 'selected' : '' }}>A</option>
														<option value="B" {{ ($patient->blood_group === 'B') ? 'selected' : '' }}>B</option>
														<option value="AB" {{ ($patient->blood_group === 'AB') ? 'selected' : '' }}>AB</option>
														<option value="O" {{ ($patient->blood_group === 'O') ? 'selected' : '' }}>O</option>
													</select>
												</div>
											</div>

											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Rhesus</label>
													<select class="form-control select" name="rhesus">
														<option value="-" {{ ($patient->rhesus === '-') ? 'selected' : '' }}>Negative</option>
														<option value="+" {{ ($patient->rhesus === '+') ? 'selected' : '' }}>Positive</option>
													</select>
												</div>
											</div>

											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Email ID</label>
													<input type="email" class="form-control" value="{{$patient->email}}" name="email">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Mobile</label>
													<input type="text" value="{{$patient->phone_number}}" class="form-control" name="phone_number">
												</div>
											</div>
											<div class="col-12">
												<div class="form-group">
												<label>Address</label>
													<input type="text" class="form-control" value="{{$patient->address}}" name="address">
												</div>
											</div>
											<!--<div class="col-12 col-md-6">
												<div class="form-group">
													<label>City</label>
													<input type="text" class="form-control" value="Old Forge">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>State</label>
													<input type="text" class="form-control" value="Newyork">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Zip Code</label>
													<input type="text" class="form-control" value="13420">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Country</label>
													<input type="text" class="form-control" value="United States">
												</div>
											</div>
										</div>-->
										<div class="submit-section">
											<button class="btn btn-primary submit-btn">Save Changes</button>
										</div>
									</form>
									<!-- /Profile Settings Form -->
									
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
      
        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery.min.js') }}"></script>
        <script>
	      function readURL(input) {
	            if (input.files && input.files[0]) {
	                var reader = new FileReader();
	                reader.onload = function(e) {
	                    $('#blah').attr('src', e.target.result)
	                }
	            reader.readAsDataURL(input.files[0]);
	            }
	        }

	      $('#imgInp').change(function(){
	          readURL(this)
	      });
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