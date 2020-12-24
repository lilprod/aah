<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>AAH+ - Doctor Profile</title>
		
		<!-- Favicons -->
		<link href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">

		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fancybox/jquery.fancybox.min.css') }}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css') }}">

		<link rel="stylesheet" type="text/css" href="{{asset('css/btn.css') }}">

		<link href="{{asset('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper" id="app">
		
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
									<li class="breadcrumb-item active" aria-current="page">Doctor Profile</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Doctor Profile <span style="color: #26a9e166">+</span></h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container">

					<!-- Doctor Widget -->
					<div class="card">
						<div class="card-body">
							<div class="doctor-widget">
								<div class="doc-info-left">
									<div class="doctor-img">
										<img src="{{url('/storage/profile_images/'.$doctor->profile_picture ) }}" class="img-fluid" alt="User Image">
									</div>
									<div class="doc-info-cont">
										<h4 class="doc-name">Dr. {{$doctor->name}} {{$doctor->firstname}}</h4>
										<p class="doc-speciality">{{$doctor->speciality->title}}</p>
										<p class="doc-department"><img src="{{url('/storage/cover_images/'.$doctor->speciality->cover_image ) }}" class="img-fluid" alt="Speciality">{{$doctor->speciality->title}}</p>
										<div class="rating">
											<!--<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star filled"></i>
											<i class="fas fa-star"></i>
											<span class="d-inline-block average-rating">(35)</span>-->
											<input id="rating-system" type="number" class="rating" min="0" max="5" step="1" name="rating" value="{{ $doctor->averageRating }}" disabled>
										</div>
										<div class="clinic-details">
											@if($doctor->exercie_place != '')
											<p class="doc-location"><i class="fas fa-map-marker-alt"></i> {{$doctor->exercie_place}} <!-- - <a href="javascript:void(0);">Get Directions</a></p>-->
											@endif
											<!--<ul class="clinic-gallery">
												<li>
													<a href="{{asset('assets/img/features/feature-01.jpg') }}" data-fancybox="gallery">
														<img src="{{asset('assets/img/features/feature-01.jpg') }}" alt="Feature">
													</a>
												</li>
												<li>
													<a href="{{asset('assets/img/features/feature-02.jpg') }}" data-fancybox="gallery">
														<img  src="{{asset('assets/img/features/feature-02.jpg') }}" alt="Feature Image">
													</a>
												</li>
												<li>
													<a href="{{asset('assets/img/features/feature-03.jpg') }}" data-fancybox="gallery">
														<img src="{{asset('assets/img/features/feature-03.jpg') }}" alt="Feature">
													</a>
												</li>
												<li>
													<a href="{{asset('assets/img/features/feature-04.jpg') }}" data-fancybox="gallery">
														<img src="{{asset('assets/img/features/feature-04.jpg') }}" alt="Feature">
													</a>
												</li>
											</ul>-->
										</div>
										@if($services != '')
										<div class="clinic-services">
											@foreach($services as $service)
											<span>{{$service->service_title}}</span>
											@endforeach
										</div>
										@endif
									</div>
								</div>
								<div class="doc-info-right">
									<div class="clini-infos">
										<ul>
											<!--<li><i class="far fa-thumbs-up"></i> 99%</li>
											<li><i class="far fa-comment"></i> 35 Feedback</li>-->
											<li><i class="fas fa-map-marker-alt"></i>@if($doctor->city != '') {{$doctor->city}}, @endif{{$doctor->country}}</li>
											<li><i class="far fa-money-bill-alt"></i> $100 per hour </li>
										</ul>
									</div>
									<div class="doctor-action">
										@if ((Auth::check()) && (Auth()->user()->role_id == 1))
										        <favourite
										            :doctor={{ $doctor->id }}
										            :favorited={{ $doctor->favorited() ? 'true' : 'false' }}
										        ></favourite>
											@endif
										
										<!--<a href="#" class="btn btn-white msg-btn">
											<i class="far fa-comment-alt"></i>
										</a>
										<a href="javascript:void(0)" class="btn btn-white fav-btn">
											<i class="far fa-bookmark"></i>
										</a>

										<a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal" data-target="#voice_call">
											<i class="fas fa-phone"></i>
										</a>
										<a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal" data-target="#video_call">
											<i class="fas fa-video"></i>
										</a>-->
									</div>
									<div class="clinic-booking">
										<a class="apt-btn" href="{{route('booking.doctor', $doctor->id)}}">Book Appointment</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Doctor Widget -->
					
					<!-- Doctor Details Tab -->
					<div class="card">
						<div class="card-body pt-0">
						
							<!-- Tab Menu -->
							<nav class="user-tabs mb-4">
								<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
									<li class="nav-item">
										<a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#doc_locations" data-toggle="tab">Locations</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#doc_reviews" data-toggle="tab">Reviews</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#doc_business_hours" data-toggle="tab">Business Hours</a>
									</li>
								</ul>
							</nav>
							<!-- /Tab Menu -->
							
							<!-- Tab Content -->
							<div class="tab-content pt-0">
							
								<!-- Overview Content -->
								<div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
									<div class="row">
										<div class="col-md-12 col-lg-9">
										
											<!-- About Details -->
											@if($doctor->biography != '')
											<div class="widget about-widget">
												<h4 class="widget-title">About Me</h4>
												<p>{{$doctor->biography}}</p>
											</div>
											@endif
											<!-- /About Details -->
										
											<!-- Education Details -->
											<div class="widget education-widget">
												<h4 class="widget-title">Education</h4>
												<div class="experience-box">
													<ul class="experience-list">
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<a href="#/" class="name">American Dental Medical University</a>
																	<div>BDS</div>
																	<span class="time">1998 - 2003</span>
																</div>
															</div>
														</li>
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<a href="#/" class="name">American Dental Medical University</a>
																	<div>MDS</div>
																	<span class="time">2003 - 2005</span>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div>
											<!-- /Education Details -->
									
											<!-- Experience Details -->
											<div class="widget experience-widget">
												<h4 class="widget-title">Work & Experience</h4>
												<div class="experience-box">
													<ul class="experience-list">
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<a href="#/" class="name">Glowing Smiles Family Dental Clinic</a>
																	<span class="time">2010 - Present (5 years)</span>
																</div>
															</div>
														</li>
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<a href="#/" class="name">Comfort Care Dental Clinic</a>
																	<span class="time">2007 - 2010 (3 years)</span>
																</div>
															</div>
														</li>
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<a href="#/" class="name">Dream Smile Dental Practice</a>
																	<span class="time">2005 - 2007 (2 years)</span>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div>
											<!-- /Experience Details -->
								
											<!-- Awards Details -->
											<div class="widget awards-widget">
												<h4 class="widget-title">Awards</h4>
												<div class="experience-box">
													<ul class="experience-list">
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<p class="exp-year">July 2019</p>
																	<h4 class="exp-title">Humanitarian Award</h4>
																	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<p class="exp-year">March 2011</p>
																	<h4 class="exp-title">Certificate for International Volunteer Service</h4>
																	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="experience-user">
																<div class="before-circle"></div>
															</div>
															<div class="experience-content">
																<div class="timeline-content">
																	<p class="exp-year">May 2008</p>
																	<h4 class="exp-title">The Dental Professional of The Year Award</h4>
																	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin a ipsum tellus. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div>
											<!-- /Awards Details -->
											
											<!-- Services List -->
											<div class="service-list">
												<h4>Services</h4>
												<ul class="clearfix">
													<li>Tooth cleaning </li>
													<li>Root Canal Therapy</li>
													<li>Implants</li>
													<li>Composite Bonding</li>
													<li>Fissure Sealants</li>
													<li>Surgical Extractions</li>
												</ul>
											</div>
											<!-- /Services List -->
											
											<!-- Specializations List -->
											<div class="service-list">
												<h4>Specializations</h4>
												<ul class="clearfix">
													<li>Children Care</li>
													<li>Dental Care</li>	
													<li>Oral and Maxillofacial Surgery </li>	
													<li>Orthodontist</li>	
													<li>Periodontist</li>	
													<li>Prosthodontics</li>	
												</ul>
											</div>
											<!-- /Specializations List -->

										</div>
									</div>
								</div>
								<!-- /Overview Content -->
								
								<!-- Locations Content -->
								<div role="tabpanel" id="doc_locations" class="tab-pane fade">
								
									<!-- Location List -->
									<div class="location-list">
										<div class="row">
										
											<!-- Clinic Content -->
											<div class="col-md-6">
												<div class="clinic-content">
													<h4 class="clinic-name"><a href="#">Smile Cute Dental Care Center</a></h4>
													<p class="doc-speciality">MDS - Periodontology and Oral Implantology, BDS</p>
													<div class="rating">
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star filled"></i>
														<i class="fas fa-star"></i>
														<span class="d-inline-block average-rating">(4)</span>
													</div>
													<div class="clinic-details mb-0">
														<h5 class="clinic-direction"> <i class="fas fa-map-marker-alt"></i> 2286  Sundown Lane, Austin, Texas 78749, USA <!--<br><a href="javascript:void(0);">Get Directions</a></h5>-->
														<ul>
															<li>
																<a href="{{asset('assets/img/features/feature-01.jpg') }}" data-fancybox="gallery2">
																	<img src="{{asset('assets/img/features/feature-01.jpg') }}" alt="Feature Image">
																</a>
															</li>
															<li>
																<a href="{{asset('assets/img/features/feature-02.jpg') }}" data-fancybox="gallery2">
																	<img src="{{asset('assets/img/features/feature-02.jpg') }}" alt="Feature Image">
																</a>
															</li>
															<li>
																<a href="{{asset('assets/img/features/feature-03.jpg') }}" data-fancybox="gallery2">
																	<img src="{{asset('assets/img/features/feature-03.jpg') }}" alt="Feature Image">
																</a>
															</li>
															<li>
																<a href="{{asset('assets/img/features/feature-04.jpg') }}" data-fancybox="gallery2">
																	<img src="{{asset('assets/img/features/feature-04.jpg') }}" alt="Feature Image">
																</a>
															</li>
														</ul>
													</div>
												</div>
											</div>
											<!-- /Clinic Content -->
											
											<!-- Clinic Timing -->
											<div class="col-md-4">
												<div class="clinic-timing">
													<div>
														<p class="timings-days">
															<span> Mon - Sat </span>
														</p>
														<p class="timings-times">
															<span>10:00 AM - 2:00 PM</span>
															<span>4:00 PM - 9:00 PM</span>
														</p>
													</div>
													<div>
													<p class="timings-days">
														<span>Sun</span>
													</p>
													<p class="timings-times">
														<span>10:00 AM - 2:00 PM</span>
													</p>
													</div>
												</div>
											</div>
											<!-- /Clinic Timing -->
											
											<div class="col-md-2">
												<div class="consult-price">
													$250
												</div>
											</div>
										</div>
									</div>
									<!-- /Location List -->

								</div>
								<!-- /Locations Content -->
								
								<!-- Reviews Content -->
								<div role="tabpanel" id="doc_reviews" class="tab-pane fade">
								
									<!-- Review Listing -->
									<div class="widget review-listing">
										<ul class="comments-list">
										
										@foreach($reviews as $review)
											<!-- Comment List -->
											<li>
												<div class="comment">
													<img class="avatar avatar-sm rounded-circle" alt="User Image" src="{{url('/storage/profile_images/'.$review->user->profile_picture ) }}">
													<div class="comment-body">
														<div class="meta-data">
															<span class="comment-author">{{$review->user->name}} {{$review->user->firstname}}</span>
															<span class="comment-date">Reviewed 2 Days ago</span>
															<div class="review-count rating">
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star filled"></i>
																<i class="fas fa-star"></i>
															</div>
														</div>

														@if($review->recommend != '')
														<p class="recommended"><i class="far fa-thumbs-up"></i> I recommend the doctor</p>
														@endif

														<p class="comment-content">
															{{$review->body}}
														</p>

														
															<div class="comment-reply">
																
																<a class="comment-btn" href="#">
																	<i class="fas fa-reply"></i> Reply
																</a>

															   <p class="recommend-btn">
																	<span>Recommend?</span>
																	<a href="#" class="like-btn">
																		<i class="far fa-thumbs-up"></i> Yes
																	</a>
																	<a href="#" class="dislike-btn">
																		<i class="far fa-thumbs-down"></i> No
																	</a>
																</p>
															</div>
														

														<div class="write-review" id="review_comment" style="display: none;">
															<form method="POST" action="{{route('review_answers_store')}}">
																{{ csrf_field() }}
															<div class="form-group">

																<input type="hidden" name="review_id" value="{{$review->id}}">

																<input type="hidden" name="doctor_id" value="{{$review->doctor->id}}">

																<input type="hidden" name="patient_id" value="{{$review->patient->id}}">

																<label>Your Comment</label>
																<textarea id="review_desc" maxlength="100" class="form-control" name="body"></textarea>
															  
															  <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars">100</span> characters remaining</small></div>
															</div>

															<div class="submit-section">
																	<button type="submit" class="btn btn-primary submit-btn">Add Comment</button>
																</div>
															</form>
														</div>
													</div>
												</div>
												
												<!-- Comment Reply -->
												<ul class="comments-reply">

													@foreach($review->answers as $answer)
													<li>
														<div class="comment">
															<img class="avatar avatar-sm rounded-circle" alt="User Image" src="{{url('/storage/profile_images/'.$answer->user->profile_picture ) }}">
															<div class="comment-body">
																<div class="meta-data">
																	<span class="comment-author">{{$answer->user->name}} {{$answer->user->firstname}}</span>
																	<span class="comment-date">Reviewed 3 Days ago</span>
																	<div class="review-count rating">
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star filled"></i>
																		<i class="fas fa-star"></i>
																	</div>
																</div>
																<p class="comment-content">
																	{{$answer->body}}
																</p>
																<div class="comment-reply">
																	<a class="comment-btn" href="#">
																		<i class="fas fa-reply"></i> Reply
																	</a>
																	<p class="recommend-btn">
																		<span>Recommend?</span>
																		<a href="#" class="like-btn">
																			<i class="far fa-thumbs-up"></i> Yes
																		</a>
																		<a href="#" class="dislike-btn">
																			<i class="far fa-thumbs-down"></i> No
																		</a>
																	</p>
																</div>
															</div>
														</div>
													</li>
													@endforeach
												</ul>
												<!-- /Comment Reply -->
												
											</li>
											<!-- /Comment List -->

											@endforeach
											
										</ul>
										
										<!-- Show All -->
										<!--<div class="all-feedback text-center">
											<a href="#" class="btn btn-primary btn-sm">
												Show all feedback <strong>(167)</strong>
											</a>
										</div>-->
										<!-- /Show All -->
										
									</div>
									<!-- /Review Listing -->
									
									@auth
									<!-- Write Review -->
									<div class="write-review">
										<h4>Write a review for <strong>Dr. {{$doctor->name}} {{$doctor->firstname}}</strong></h4>
										
										<!-- Write Review Form -->
										<form method="POST" action="{{ route('ratings.store') }}" enctype="multipart/form-data">
                                		{{csrf_field()}}

											<div class="form-group">

												<input type="hidden" name="doctor_id" id="doctor" class="form-control" value="{{$doctor->id}}">

                                        		<input type="hidden" name="user_id" id="patient" class="form-control" value="{{auth()->user()->id}}">

												<label>Review</label>
												<div class="star-rating">
													<!--<input id="star-5" type="radio" name="rating" value="star-5">
													<label for="star-5" title="5 stars">
														<i class="active fa fa-star"></i>
													</label>
													<input id="star-4" type="radio" name="rating" value="star-4">
													<label for="star-4" title="4 stars">
														<i class="active fa fa-star"></i>
													</label>
													<input id="star-3" type="radio" name="rating" value="star-3">
													<label for="star-3" title="3 stars">
														<i class="active fa fa-star"></i>
													</label>
													<input id="star-2" type="radio" name="rating" value="star-2">
													<label for="star-2" title="2 stars">
														<i class="active fa fa-star"></i>
													</label>
													<input id="star-1" type="radio" name="rating" value="star-1">
													<label for="star-1" title="1 star">
														<i class="active fa fa-star"></i>
													</label>-->
													<input id="rating-system" type="number" class="rating" min="0" max="5" step="1" name="rating" value="{{ auth()->user()->userAverageRating($doctor->id) }}">
												</div>
											</div>
											<div class="form-group">
												<label>Title of your review</label>
												<input class="form-control" type="text" placeholder="If you could say it in one sentence, what would you say?" name="title">
											</div>
											<div class="form-group">
												<label>Your review</label>
												<textarea id="review_desc" maxlength="100" class="form-control" name="body"></textarea>
											  
											  <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars">100</span> characters remaining</small></div>
											</div>
											<hr>
											<!--<div class="form-group">
												<div class="terms-accept">
													<div class="custom-checkbox">
													   <input type="checkbox" id="terms_accept">
													   <label for="terms_accept">I have read and accept <a href="#">Terms &amp; Conditions</a></label>
													</div>
												</div>
											</div>-->
											<div class="submit-section">
												<button type="submit" class="btn btn-primary submit-btn">Add Review</button>
											</div>
										</form>
										<!-- /Write Review Form -->
										
									</div>
									<!-- /Write Review -->
									@endauth
						
								</div>
								<!-- /Reviews Content -->
								
								<!-- Business Hours Content -->
								<div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
									<div class="row">
										<div class="col-md-6 offset-md-3">
										
											<!-- Business Hours Widget -->
											<div class="widget business-widget">
												<div class="widget-content">
													<div class="listing-hours">
														<div class="listing-day current">
															<div class="day">Today <span>{{$date->format('d M Y')}}</span></div>
															<div class="time-items">
																<span class="open-status"><span class="badge bg-success-light">Open Now</span></span>
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Monday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Tuesday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Wednesday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Thursday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Friday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day">
															<div class="day">Saturday</div>
															<div class="time-items">
																<span class="time">07:00 AM - 09:00 PM</span>
															</div>
														</div>
														<div class="listing-day closed">
															<div class="day">Sunday</div>
															<div class="time-items">
																<span class="time"><span class="badge bg-danger-light">Closed</span></span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- /Business Hours Widget -->
									
										</div>
									</div>
								</div>
								<!-- /Business Hours Content -->
								
							</div>
						</div>
					</div>
					<!-- /Doctor Details Tab -->

				</div>
			</div>		
			<!-- /Page Content -->
   
			<!-- Footer -->
			<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-chevron-up"></i></button>
			@include('website.footer')
			<!-- /Footer -->
		   
		</div>
		<!-- /Main Wrapper -->
		
		<!-- Voice Call Modal -->
		<div class="modal fade call-modal" id="voice_call">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<!-- Outgoing Call -->
						<div class="call-box incoming-box">
							<div class="call-wrapper">
								<div class="call-inner">
									<div class="call-user">
										<img alt="User Image" src="assets/img/doctors/doctor-thumb-02.jpg" class="call-avatar">
										<h4>Dr. Darren Elder</h4>
										<span>Connecting...</span>
									</div>							
									<div class="call-items">
										<a href="javascript:void(0);" class="btn call-item call-end" data-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
										<a href="voice-call.html" class="btn call-item call-start"><i class="material-icons">call</i></a>
									</div>
								</div>
							</div>
						</div>
						<!-- Outgoing Call -->

					</div>
				</div>
			</div>
		</div>
		<!-- /Voice Call Modal -->
		
		<!-- Video Call Modal -->
		<div class="modal fade call-modal" id="video_call">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
					
						<!-- Incoming Call -->
						<div class="call-box incoming-box">
							<div class="call-wrapper">
								<div class="call-inner">
									<div class="call-user">
										<img class="call-avatar" src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image">
										<h4>Dr. Darren Elder</h4>
										<span>Calling ...</span>
									</div>							
									<div class="call-items">
										<a href="javascript:void(0);" class="btn call-item call-end" data-dismiss="modal" aria-label="Close"><i class="material-icons">call_end</i></a>
										<a href="video-call.html" class="btn call-item call-start"><i class="material-icons">videocam</i></a>
									</div>
								</div>
							</div>
						</div>
						<!-- /Incoming Call -->
						
					</div>
				</div>
			</div>
		</div>
		<!-- Video Call Modal -->
		
		
		

		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>

		<script src="{{asset('js/star-rating.js') }}" type="text/javascript"></script>

		<script src="{{ asset('js/app.js') }}"></script>

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

		<!-- Fancybox JS -->
		<script src="{{asset('assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>

		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>