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
		<!-- /Breadcrumb -->

	<!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <!-- Profile Sidebar -->
					@include('patients.partials.profile_side')
					<!-- / Profile Sidebar -->

						<div class="col-md-7 col-lg-8 col-xl-9">

							@include('inc.messages')

							<span id="message"></span>

							<div class="card">

								<div class="card-body">

									<!-- Profile Settings Form -->
									<form method="POST" action="{{route('post_patient_setting')}}" enctype="multipart/form-data">
										{{ csrf_field() }}
										<input type="hidden" class="form-control" id="patient_id" name="patient_id" value="{{$patient->id}}">

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

											<div class="col-md-6">
												<div class="form-group">
													<label>Patient ID <span class="text-danger">*</span></label>
													<input type="text" class="form-control" readonly value="{{$patient->matricule}}">
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label>Email <span class="text-danger">*</span></label>
													<input type="email" class="form-control" readonly value="{{$patient->email}}">
												</div>
											</div>

											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>First Name</label>
													<input type="text" class="form-control" value="{{$patient->name}}" name="name" id="name">
												</div>
											</div>
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Last Name</label>
													<input type="text" class="form-control" value="{{$patient->firstname}}" name="firstname" id="firstname">
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
                                                <div class="form-group mb-3">
                                                    <label>Region</label>
                                                    <select class="form-control" id="region" name="region" required>
                                                        <option value="1" {{ ($patient->region === 'WEST AFRICA') ? 'selected' : '' }}>WEST AFRICA</option>
                                                        <option value="2" {{ ($patient->region === 'EAST AFRICA') ? 'selected' : '' }}>EAST AFRICA</option>
                                                        <option value="3" {{ ($patient->region === 'NORTHEN AFRICA') ? 'selected' : '' }}>NORTHEN AFRICA</option>
                                                        <option value="4" {{ ($patient->region === 'MIDDLE AFRICA') ? 'selected' : '' }}>MIDDLE AFRICA</option>
                                                        <option value="5" {{ ($patient->region === 'SOUTHERN AFRICA') ? 'selected' : '' }}>SOUTHERN AFRICA</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-12 col-md-6" id="old_country">
												<div class="form-group">
													<label class="control-label">Country</label>
													<input type="text" class="form-control" name="old_country"  value="{{$patient->country}}">
												</div>
											</div>

                                            <div class="col-12 col-md-6" id="country_section" style="display: none;">
                                                <div class="form-group mb-3">
                                                    <label>Country</label>
                                                    <select class="form-control" name="country" id="country">
                                                    </select>
                                                </div>
                                            </div>

										
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>City</label>
													<input type="text" class="form-control" name="city" value="{{$patient->city}}">
												</div>
											</div>

											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Mobile</label>
													<input type="text" value="{{$patient->phone_number}}" class="form-control" name="phone_number">
												</div>
											</div>

											<div class="col-12 col-md-6">
												<div class="form-group">
												<label>Address</label>
													<input type="text" class="form-control" name="address" value="{{$patient->address}}">
												</div>
											</div>

											

											<!--<div class="col-12 col-md-6">
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
											
										</div>-->

										<div class="col-12 col-md-12">
											<div class="submit-section">
												<button class="btn btn-primary submit-btn">Save Changes</button>
											</div>
										</div>
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
			                url: '{!!URL::route('patient_crop_image')!!}',
			                data: {'_token': $('meta[name="csrf-token"]').attr('content'), 'image': base64data, 'patient_id' : $('#patient_id').attr('value')},
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
        <!--<script>
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