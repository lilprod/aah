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

        <!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css') }}">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}">
		
		<link rel="stylesheet" href="{{asset('assets/plugins/dropzone/dropzone.min.css') }}">

		<link rel="stylesheet" type="text/css" href="{{asset('css/btn.css') }}">
        
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css') }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="assets/js/html5shiv.min.js"></script>
            <script src="assets/js/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">
			.image {
			display: block;
			height: 100%;
    		width: 100%;
			/*max-width: 100%;*/
			}
			.preview {
			overflow: hidden;
			width: 160px; 
			height: 160px;
			margin: 10px;
			border: 1px solid red;
			}
		</style>
    
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
									<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Profile Settings</h2>
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
						<span id="message"></span>
						<form method="POST" action="{{route('post_doctor_setting')}}" enctype="multipart/form-data">
						{{ csrf_field() }}
							<!-- Basic Information -->
							<div class="card">

								<div class="card-body">

									
									<input type="hidden" class="form-control" name="doctor_id" id="doctor_id" value="{{$doctor->id}}">

									<h4 class="card-title">Basic Information</h4>
									<div class="row form-row">
										<div class="col-md-12">
											<div class="form-group">
												<div class="change-avatar">
													<div class="profile-img">
														@if($doctor->profile_picture == '')
														<img src="{{asset('assets/img/doctors/doctor-thumb-02.jpg') }}" alt="" id="blah">
														@else
														<img src="{{url('/storage/profile_images/'.$doctor->profile_picture ) }}" alt="" id="blah">
														@endif
													</div>
													<div class="upload-img">
														<div class="change-photo-btn">
															<span><i class="fa fa-upload"></i> Upload Photo</span>
															<input type="file" id="imgInp" class="upload" name="profile_picture">
														</div>
														<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
													</div>
												</div>
											</div>
										</div>
										<!--<div class="col-md-6">
											<div class="form-group">
												<label>Username <span class="text-danger">*</span></label>
												<input type="text" class="form-control" readonly>
											</div>
										</div>-->

										<div class="col-md-6">
											<div class="form-group">
												<label>Doctor ID <span class="text-danger">*</span></label>
												<input type="text" class="form-control" readonly value="{{$doctor->matricule}}">
											</div>
										</div>


										<div class="col-md-6">
											<div class="form-group">
												<label>Email <span class="text-danger">*</span></label>
												<input type="email" class="form-control" readonly value="{{$doctor->email}}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control" value="{{$doctor->name}}" name="name" id="name">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>First Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control" value="{{$doctor->firstname}}" name="firstname" id="firstname">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Phone Number</label>
												<input type="text" class="form-control" value="{{$doctor->phone_number}}" name="phone_number">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Gender</label>
												<select class="form-control select">
													<option value="M" {{  $doctor->gender == "M" ? 'checked' : '' }}>Male</option>
													<option value="F" {{  $doctor->gender == "M" ? 'checked' : '' }}>Female</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Birth Place</label>
												<input type="text" class="form-control" value="{{$doctor->place_birth}}" name="place_birth">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group mb-0">
												<label>Date of Birth</label>
												<input type="date" class="form-control" value="{{$doctor->birth_date}}" name="birth_date">
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Basic Information -->
							
							<!-- About Me -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">About Me</h4>
									<div class="form-group mb-0">
										<label>Biography</label>
										<textarea class="form-control" rows="5" name="biography">{{$doctor->biography}}</textarea>
									</div>
								</div>
							</div>
							<!-- /About Me -->
							
							<!-- Clinic Info -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Clinic Info</h4>
									<div class="row form-row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Clinic Name</label>
												<input type="text" class="form-control" name="clinic_name">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Clinic Address</label>
												<input type="text" class="form-control" name="clinic_address">
											</div>
										</div>
										<!--<div class="col-md-12">
											<div class="form-group">
												<label>Clinic Images</label>
												<form action="#" class="dropzone"></form>
											</div>
											<div class="upload-wrap">
												<div class="upload-images">
													<img src="assets/img/features/feature-01.jpg" alt="Upload Image">
													<a href="javascript:void(0);" class="btn btn-icon btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
												</div>
												<div class="upload-images">
													<img src="assets/img/features/feature-02.jpg" alt="Upload Image">
													<a href="javascript:void(0);" class="btn btn-icon btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>
												</div>
											</div>
										</div>-->
									</div>
								</div>
							</div>
							<!-- /Clinic Info -->

							<!-- Contact Details -->
							<div class="card contact-card">
								<div class="card-body">
									<h4 class="card-title">Contact Details</h4>
									<div class="row form-row">

										<div class="col-md-12">
											<div class="form-group">
												<label>Address Line</label>
												<input type="text" class="form-control" name="address" value="{{$doctor->address}}">
											</div>
										</div>

										<!--<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Address Line 2</label>
												<input type="text" class="form-control">
											</div>
										</div>-->

										<div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label>Region</label>
                                                    <select class="form-control" id="region" name="region" required>
                                                        <option value="1" {{ ($doctor->region === 'WEST AFRICA') ? 'selected' : '' }}>WEST AFRICA</option>
                                                        <option value="2" {{ ($doctor->region === 'EAST AFRICA') ? 'selected' : '' }}>EAST AFRICA</option>
                                                        <option value="3" {{ ($doctor->region === 'NORTHEN AFRICA') ? 'selected' : '' }}>NORTHEN AFRICA</option>
                                                        <option value="4" {{ ($doctor->region === 'MIDDLE AFRICA') ? 'selected' : '' }}>MIDDLE AFRICA</option>
                                                        <option value="5" {{ ($doctor->region === 'SOUTHERN AFRICA') ? 'selected' : '' }}>SOUTHERN AFRICA</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-6" id="old_country">
												<div class="form-group">
													<label class="control-label">Country</label>
													<input type="text" class="form-control" name="old_country"  value="{{$doctor->country}}">
												</div>
											</div>

                                            <div class="col-sm-6" id="country_section" style="display: none;">
                                                <div class="form-group mb-3">
                                                    <label>Country</label>
                                                    <select class="form-control" name="country" id="country">
                                                    </select>
                                                </div>
                                            </div>
										

										<!--<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Country</label>
												<input type="text" class="form-control" name="country" value="{{$doctor->country}}">
											</div>
										</div>-->

										<!--<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">State / Province</label>
												<input type="text" class="form-control">
											</div>
										</div>-->

										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">City</label>
												<input type="text" class="form-control" name="city" value="{{$doctor->city}}">
											</div>
										</div>

										<!--<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Postal Code</label>
												<input type="text" class="form-control">
											</div>
										</div>-->
									</div>
								</div>
							</div>
							<!-- /Contact Details -->
							
							<!-- Pricing -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Pricing</h4>
									
									<!--<div class="form-group mb-0">
										<div id="pricing_select">
											<div class="custom-control custom-radio custom-control-inline">
												<input type="radio" id="price_free" name="rating_option" class="custom-control-input" value="price_free" checked>
												<label class="custom-control-label" for="price_free">Free</label>
											</div>
											<div class="custom-control custom-radio custom-control-inline">
												<input type="radio" id="price_custom" name="rating_option" value="custom_price" class="custom-control-input">
												<label class="custom-control-label" for="price_custom">Custom Price (per hour)</label>
											</div>
										</div>

									</div>
									
									<div class="row custom_price_cont" id="custom_price_cont" style="display: none;">
										<div class="col-md-4">
											<input type="text" class="form-control" id="custom_rating_input" name="custom_rating_count" value="" placeholder="20">
											<small class="form-text text-muted">Custom price you can add</small>
										</div>
									</div>-->
									<div class="row form-row">
										<div class="col-md-4">
											<input type="number" class="form-control" id="apt_fees" name="apt_fees" value="{{$doctor->apt_fees}}" placeholder="20" min="20">
											<small class="form-text text-muted">Custom price you can add</small>
										</div>
									</div>
									
								</div>
							</div>
							<!-- /Pricing -->
							
							<!-- Services and Specialization -->
							<div class="card services-card">
								<div class="card-body">
									<h4 class="card-title">Services and Specialization</h4>
									<div class="row form-row">
										<div class="col-md-6">
	                                        <div class="form-group">
	                                            <label>Title</label>
	                                            <select class="form-control" id="title" name="title">
	                                                <option value="DR" {{ ($doctor->title === 'DR') ? 'selected' : '' }}>Doctor</option>
	                                                <option value="PR" {{ ($doctor->title === 'PR') ? 'selected' : '' }}>Professor</option>
	                                            </select>
	                                        </div>
	                                    </div>

	                                    <div class="col-md-6">
	                                        <div class="form-group">
	                                            <label>Specialty</label>
	                                            <select class="form-control" id="speciality_id" name="speciality_id">
	                                                @foreach($specialities as $speciality)
	                                                    <option value="{{$speciality->id}}" {{ ($doctor->speciality_id === $speciality->id) ? 'selected' : '' }}>{{$speciality->title}}</option>
	                                                @endforeach
	                                            </select>
	                                        </div>
	                                    </div>
	                                </div>

									<div class="form-group">
										<label>Services</label>
										<input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Enter Services" name="services" value="@foreach($services as $service) {{$service->service_title}}, @endforeach" id="services">
										<small class="form-text text-muted">Note : Type & Press enter to add new services</small>
									</div> 
									<div id="services_list"></div>   
									<!--<div class="form-group mb-0">
										<label>Specialization </label>
										<input class="input-tags form-control" type="text" data-role="tagsinput" placeholder="Enter Specialization" name="specialist" value="Children Care,Dental Care" id="specialist">
										<small class="form-text text-muted">Note : Type & Press  enter to add new specialization</small>
									</div> -->

								</div>              
							</div>
							<!-- /Services and Specialization -->
						 
							<!-- Education -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Education</h4>
									<div class="education-info">
										<div class="row form-row education-cont">
											<div class="col-12 col-md-10 col-lg-11">
												<div class="row form-row">
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>Degree</label>
															<input type="text" class="form-control" name="degree[]">
														</div> 
													</div>
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>College/Institute</label>
															<input type="text" class="form-control" name="institute[]">
														</div> 
													</div>
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>Year of Completion</label>
															<input type="text" class="form-control" name="year_completion[]">
														</div> 
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="add-more">
										<a href="javascript:void(0);" class="add-education"><i class="fa fa-plus-circle"></i> Add More</a>
									</div>
								</div>
							</div>
							<!-- /Education -->
						
							<!-- Experience -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Experience</h4>
									<div class="experience-info">
										<div class="row form-row experience-cont">
											<div class="col-12 col-md-10 col-lg-11">
												<div class="row form-row">
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>Hospital Name</label>
															<input type="text" class="form-control" name="exercice_place[]">
														</div> 
													</div>
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>From</label>
															<input type="date" class="form-control" name="from[]">
														</div> 
													</div>
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>To</label>
															<input type="date" class="form-control" name="to[]">
														</div> 
													</div>
													<div class="col-12 col-md-6 col-lg-4">
														<div class="form-group">
															<label>Designation</label>
															<input type="text" class="form-control" name="designation[]">
														</div> 
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="add-more">
										<a href="javascript:void(0);" class="add-experience"><i class="fa fa-plus-circle"></i> Add More</a>
									</div>
								</div>
							</div>
							<!-- /Experience -->
							
							<!-- Awards -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Awards</h4>
									<div class="awards-info">
										<div class="row form-row awards-cont">
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Awards</label>
													<input type="text" class="form-control" name="awards[]">
												</div> 
											</div>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Year</label>
													<input type="text" class="form-control" name="year[]">
												</div> 
											</div>
										</div>
									</div>
									<div class="add-more">
										<a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i> Add More</a>
									</div>
								</div>
							</div>
							<!-- /Awards -->
							
							<!-- Memberships -->
							<!--<div class="card">
								<div class="card-body">
									<h4 class="card-title">Memberships</h4>
									<div class="membership-info">
										<div class="row form-row membership-cont">
											<div class="col-12 col-md-10 col-lg-5">
												<div class="form-group">
													<label>Memberships</label>
													<input type="text" class="form-control">
												</div> 
											</div>
										</div>
									</div>
									<div class="add-more">
										<a href="javascript:void(0);" class="add-membership"><i class="fa fa-plus-circle"></i> Add More</a>
									</div>
								</div>
							</div>-->
							<!-- /Memberships -->
							
							<!-- Registrations -->
							<!--<div class="card">
								<div class="card-body">
									<h4 class="card-title">Registrations</h4>
									<div class="registrations-info">
										<div class="row form-row reg-cont">
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Registrations</label>
													<input type="text" class="form-control">
												</div> 
											</div>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Year</label>
													<input type="text" class="form-control">
												</div> 
											</div>
										</div>
									</div>
									<div class="add-more">
										<a href="javascript:void(0);" class="add-reg"><i class="fa fa-plus-circle"></i> Add More</a>
									</div>
								</div>
							</div>-->
							<!-- /Registrations -->
							
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
			<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
                @include('website.footer')
                
            <!-- /Footer -->
           
        </div>
        <!-- /Main Wrapper -->

        <div class="modal fade bd-example-modal-xl" id="modal" tabindex="-1" aria-labelledby="myLargeModalLabel" role="document">
	      	<div class="modal-dialog modal-xl">
	        	<div class="modal-content">
	              	<div class="modal-header">
	                	<h4 class="modal-title" id="myLargeModalLabel">Crop Image Before Upload</h4>
	                	<button class="close" type="button" data-dismiss="modal" aria-label="Close" data-original-title="" title=""><span aria-hidden="true">×</span></button>
	              	</div>
	              	<div class="modal-body">
	              		<div class="img-container">
							<div class="row">
								<div class="col-md-8">
									<img class="image" id="image" src="https://avatars0.githubusercontent.com/u/3456749">
								</div>
								<div class="col-md-4">
									<div class="preview"></div>
								</div>
							</div>
						</div>
							
	              	</div>
	              	<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="button" class="btn btn-primary" id="crop">Crop</button>
					</div>
	        	</div>
	      	</div>
	    </div>
      
        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

        <script>
			var $modal = $('#modal');
			
			var image = document.getElementById('image');

			var cropper;

			$("body").on("change", ".upload", function(e){
			var files = e.target.files;
			var done = function (url) {
				image.src = url;
				$modal.modal('show');
			};

			var reader;
			var file;
			var url;

				if (files && files.length > 0) {
					file = files[0];
					if (URL) {
						done(URL.createObjectURL(file));
					} else if (FileReader) {
						reader = new FileReader();
						reader.onload = function (e) {
							done(reader.result);
						};
						reader.readAsDataURL(file);
					}
				}
			});

			$modal.on('shown.bs.modal', function () {
			    cropper = new Cropper(image, {
			      aspectRatio: 1,
			      viewMode: 3,
			      preview: '.preview'
			    });
			}).on('hidden.bs.modal', function () {
			  cropper.destroy();
			   cropper = null;
			});

			$("#crop").click(function(){
				canvas = cropper.getCroppedCanvas({
				width: 160,
				height: 160,
				});


			    canvas.toBlob(function(blob) {
			        url = URL.createObjectURL(blob);
			        var reader = new FileReader();
			         reader.readAsDataURL(blob); 
			         reader.onloadend = function() {
			            var base64data = reader.result; 

			            console.log(base64data);

			            $.ajax({
			                type: 'POST',
			                dataType: 'json',
			                url: '{!!URL::route('doctor_crop_image')!!}',
			                data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'image': base64data, 'doctor_id' : $('#doctor_id').attr('value')},
			                success: function(data){
			                    //console.log(data);
			                    $modal.modal('hide');
			                    //alert("Crop image successfully uploaded");
			                    
			                    $('#message').html('<div class="alert alert-success alert-dismissible fade show" role="alert"> <span><b>Crop image successfully uploaded</b> </span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>'); // Diplay message

			                    $('input[id=image1]').val('');

			                    location.reload();


			                }
			              });
			         }
			    });
			})
		</script>

       <!-- <script>
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
	    </script>-->

	    <script type="text/javascript">
            $(document).ready(function() {

                $('#name').keyup(function(){
                    $(this).val($(this).val().toUpperCase());
                });

                $('#firstname').keyup(function() 
                {
                    var str = $('#firstname').val();
                   
                    
                    var spart = str.split(" ");
                    for ( var i = 0; i < spart.length; i++ )
                    {
                        var j = spart[i].charAt(0).toUpperCase();
                        spart[i] = j + spart[i].substr(1);
                    }

                  $('#firstname').val(spart.join(" "));
                
                });

                 $('#region').on('change', function () {

                    var region_id = $(this).val();

                    if(region_id){
                        $.ajax({
                            url: '{!!URL::route('getCountries')!!}',
                            type: 'GET',
                            data : { 'id' : region_id},
                            dataType: 'json',

                            success:function(data){
                                //console.log('data');

                                if(data) {

                                	$('#country_section').attr("style", "display:block");

                                	$('#old_country').attr("style", "display:none");

                                    $('#country').empty();

                                    $('#country').focus;

                                    $('#country').append('<option value = "">--Select Country--</option>');

                                    $.each(data, function(key, value){
                                        $('select[name = "country"]').append('<option value= "'+ value.title +'">' + value.title + '</option>');
                                    });

                                    //$('select[name = "country"]').selectmenu('refresh', true);

                                    //$('select[name = "country"]').refresh();

                                    } else {
                                        $('#country').empty();
                                    } 
                                }
                                });
                            }
                            else{
                                $('#country').empty();
                            }
                        
                 });
            });
            </script>

	    <script type="text/javascript">
			// When the user scrolls down 20px from the top of the document, show the button
			window.onscroll = function() {scrollFunction()};

			function scrollFunction() {
			  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			    document.getElementById("myBtn").style.display = "block";
			  } else {
			    document.getElementById("myBtn").style.display = "none";
			  }
			}

			// When the user clicks on the button, scroll to the top of the document
			function topFunction() {
			  document.body.scrollTop = 0; // For Safari
			  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
			}
		</script>

		<!-- Chosen JS -->

        
        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

        <!-- Select2 JS -->
		<script src="{{asset('assets/plugins/select2/js/select2.min.js') }}"></script>
		
		<!-- Dropzone JS -->
		<script src="{{asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
		
		<!-- Bootstrap Tagsinput JS -->
		<script src="{{asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}"></script>
		
		<!-- Profile Settings JS -->
		<script src="{{asset('assets/js/profile-settings.js') }}"></script>

        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
        
    </body>
</html>