<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - Reviews</title>
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
									<li class="breadcrumb-item"><a href="{{('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Reviews</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Reviews <span style="color: #26a9e166">+</span></h2>
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

							<div class="doc-review review-listing">
							
								<!-- Review Listing -->
								<ul class="comments-list">

									@foreach($reviews as $review)
									<!-- Comment List -->
									<li>
										<div class="comment">
											<img class="avatar rounded-circle" alt="User Image" src="{{url('/storage/profile_images/'.$review->patient->profile_picture ) }}">
											<div class="comment-body">
												<div class="meta-data">
													<span class="comment-author">{{$review->patient->name}} {{$review->patient->firstname}}</span>
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
													<a class="comment-btn" href="#" id="comment_btn">
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
											<!-- Comment Reply List -->
											<li>
												<div class="comment">
													<img class="avatar rounded-circle" alt="User Image" src="{{url('/storage/profile_images/'.$answer->doctor->profile_picture ) }}">
													<div class="comment-body">
														<div class="meta-data">
															<span class="comment-author">Dr. {{$answer->doctor->name }} {{$answer->doctor->firstname}}</span>
															<span class="comment-date">Reviewed 3 Days ago</span>
														</div>
														<p class="comment-content">
															{{$answer->body}}
														</p>
														<div class="comment-reply">
															<a class="comment-btn" href="#" id="reply_btn">
																<i class="fas fa-reply"></i> Reply
															</a>
														</div>

														<div class="write-review" id="comment_reply" style="display: none;">
														<form method="POST" action="{{route('answers_replies_store')}}">
															{{ csrf_field() }}
														<div class="form-group">

															<input type="hidden" name="review_id" value="{{$review->id}}">

															<input type="hidden" name="doctor_id" value="{{$answer->doctor->id}}">

															<input type="hidden" name="patient_id" value="{{$answer->patient->id}}">

															<label>Your Comment</label>
															<textarea id="review_desc" maxlength="100" class="form-control" name="body"></textarea>
														  
														  <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars">100</span> characters remaining</small></div>
														</div>

														<div class="submit-section">
																<button type="submit" class="btn btn-primary submit-btn">Reply</button>
															</div>
														</form>
													</div>
													</div>
												</div>
											</li>
											<!-- /Comment Reply List -->
											@endforeach
										</ul>
										<!-- /Comment Reply -->
										
									</li>
									<!-- /Comment List -->

									@endforeach
									
								</ul>
								<!-- /Comment List -->
								
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
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>

		<script>
			
			$("#comment_btn").click(function () {
		      $("#review_comment").css("display","block");
		    });

		    $("#reply_btn").click(function () {
		      $("#comment_reply").css("display","block");
		    });

		</script>

		<script src="{{asset('js/star-rating.js') }}" type="text/javascript"></script>

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