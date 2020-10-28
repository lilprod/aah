<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Telemed AAH - Blog Details</title>
		
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

		@include('website.hearder')

		<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Blog</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Blog Details <span style="color: #26a9e166">+</span></h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->

			<!-- Page Content -->
			<div class="content">
				<div class="container">
					<div class="row">

						<div class="col-lg-8 col-md-12">
							<div class="blog-view">
								<div class="blog blog-single-post">
									<div class="blog-image">
										<a href="javascript:void(0);"><img alt="" src="{{url('/storage/cover_images/'.$post->cover_image ) }}" class="img-fluid"></a>
									</div>
									<h3 class="blog-title">{{$post->title}}</h3>
									<div class="blog-info clearfix">
										<div class="post-left">
											<ul>
												<li>
													<div class="post-author">
														<a href="#"><img src="{{url('/storage/profile_images/'.$post->author_image ) }}" alt="Post Author"> <span>Dr. {{$post->author}}</span></a>
													</div>
												</li>
												<li><i class="far fa-calendar"></i> {{ $post->created_at->format('m/d/Y') }}</li>
												<!--<li><i class="far fa-comments"></i>12 Comments</li>-->
												<li><i class="fa fa-tags"></i>{{$post->category->title}}</li>
											</ul>
										</div>
									</div>
									<div class="blog-content">
										<p>{!! $post->body!!}</p>
									</div>
								</div>
								
								<div class="card blog-share clearfix">
									<div class="card-header">
										<h4 class="card-title">Share the post</h4>
									</div>
									<div class="card-body">
										<ul class="social-share">
											<li><a href="#" title="Facebook"><i class="fab fa-facebook"></i></a></li>
											<li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
											<li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
											<li><a href="#" title="Google Plus"><i class="fab fa-google-plus"></i></a></li>
											<li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
										</ul>
									</div>
								</div>

								<div class="card-footer">
			                      <a href="{{ url()->previous() }}" class="btn btn-primary pull-right"><i class="fa fa-arrow-left"></i> Retour </a>
			                    </div>
								<!--<div class="card author-widget clearfix">
								<div class="card-header">
									<h4 class="card-title">About Author</h4>
									</div>
								<div class="card-body">
									<div class="about-author">
										<div class="about-author-img">
											<div class="author-img-wrap">
												<a href="doctor-profile.html"><img class="img-fluid rounded-circle" alt="" src="assets/img/doctors/doctor-thumb-02.jpg"></a>
											</div>
										</div>
										<div class="author-details">
											<a href="doctor-profile.html" class="blog-author-name">Dr. Darren Elder</a>
											<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
										</div>
									</div>
								</div>
								</div>-->
								<!--<div class="card blog-comments clearfix">
									<div class="card-header">
										<h4 class="card-title">Comments (12)</h4>
									</div>
									<div class="card-body pb-0">
									<ul class="comments-list">
										<li>
											<div class="comment">
												<div class="comment-author">
													<img class="avatar" alt="" src="assets/img/patients/patient4.jpg">
												</div>
												<div class="comment-block">
													<span class="comment-by">
														<span class="blog-author-name">Michelle Fairfax</span>
													</span>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
													<p class="blog-date">Dec 6, 2017</p>
													<a class="comment-btn" href="#">
														<i class="fas fa-reply"></i> Reply
													</a>
												</div>
											</div>
											<ul class="comments-list reply">
												<li>
													<div class="comment">
														<div class="comment-author">
															<img class="avatar" alt="" src="assets/img/patients/patient5.jpg">
														</div>
														<div class="comment-block">
															<span class="comment-by">
																<span class="blog-author-name">Gina Moore</span>
															</span>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae.</p>
															<p class="blog-date">Dec 6, 2017</p>
													<a class="comment-btn" href="#">
														<i class="fas fa-reply"></i> Reply
													</a>
														</div>
													</div>
												</li>
												<li>
													<div class="comment">
														<div class="comment-author">
															<img class="avatar" alt="" src="assets/img/patients/patient3.jpg">
														</div>
														<div class="comment-block">
															<span class="comment-by">
																<span class="blog-author-name">Carl Kelly</span>
															</span>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae.</p>
															<p class="blog-date">December 7, 2017</p>
													<a class="comment-btn" href="#">
														<i class="fas fa-reply"></i> Reply
													</a>
														</div>
													</div>
												</li>
											</ul>
										</li>
										<li>
											<div class="comment">
												<div class="comment-author">
													<img class="avatar" alt="" src="assets/img/patients/patient6.jpg">
												</div>
												<div class="comment-block">
													<span class="comment-by">
														<span class="blog-author-name">Elsie Gilley</span>
													</span>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
													<p class="blog-date">December 11, 2017</p>
												</div>
											</div>
										</li>
										<li>
											<div class="comment">
												<div class="comment-author">
													<img class="avatar" alt="" src="assets/img/patients/patient7.jpg">
												</div>
												<div class="comment-block">
													<span class="comment-by">
														<span class="blog-author-name">Joan Gardner</span>
													</span>
													<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
													<p class="blog-date">December 13, 2017</p>
													<a class="comment-btn" href="#">
														<i class="fas fa-reply"></i> Reply
													</a>
												</div>
											</div>
										</li>
									</ul>
								</div>
								</div>-->
								
								<!--<div class="card new-comment clearfix">
									<div class="card-header">
										<h4 class="card-title">Leave Comment</h4>
									</div>
									<div class="card-body">
										<form>
											<div class="form-group">
												<label>Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control">
											</div>
											<div class="form-group">
												<label>Your Email Address <span class="text-danger">*</span></label>
												<input type="email" class="form-control">
											</div>
											<div class="form-group">
												<label>Comments</label>
												<textarea rows="4" class="form-control"></textarea>
											</div>
											<div class="submit-section">
												<button class="btn btn-primary submit-btn" type="submit">Submit</button>
											</div>
										</form>
									</div>
								</div>-->
								
							</div>
						</div>
					

						<!-- Blog Sidebar -->
						<div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

							<!-- Search -->
							<div class="card search-widget">
								<div class="card-body">
									<form class="search-form">
										<div class="input-group">
											<input type="text" placeholder="Search..." class="form-control">
											<div class="input-group-append">
												<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<!-- /Search -->

							<!-- Latest Posts -->
							<div class="card post-widget">
								<div class="card-header">
									<h4 class="card-title">Latest Posts</h4>
								</div>
								<div class="card-body">
									<ul class="latest-posts">
										@foreach($latestposts as $post)
										<li>
											<div class="post-thumb">
												<a href="{{$post->getLink()}}">
													<img class="img-fluid" src="{{url('/storage/cover_images/'.$post->cover_image ) }}" alt="">
												</a>
											</div>
											<div class="post-info">
												<h4>
													<a href="{{$post->getLink()}}">{{$post->title}}</a>
												</h4>
												<p>{{ $post->created_at->format('m/d/Y') }}</p>
											</div>
										</li>
										@endforeach
									</ul>
								</div>
							</div>
							<!-- /Latest Posts -->

							<!-- Categories -->
							<div class="card category-widget">
								<div class="card-header">
									<h4 class="card-title">Blog Categories</h4>
								</div>
								<div class="card-body">
									<ul class="categories">
										@foreach($categories as $category)
											<li><a href="{{$category->getLink()}}">{{$category->title}} <span><!--(62)--></span></a></li>
										@endforeach
								</div>
							</div>
							<!-- /Categories -->

							<!-- Tags -->
							<!--<div class="card tags-widget">
								<div class="card-header">
									<h4 class="card-title">Tags</h4>
								</div>
								<div class="card-body">
									<ul class="tags">
										<li><a href="#" class="tag">Children</a></li>
										<li><a href="#" class="tag">Disease</a></li>
										<li><a href="#" class="tag">Appointment</a></li>
										<li><a href="#" class="tag">Booking</a></li>
										<li><a href="#" class="tag">Kids</a></li>
										<li><a href="#" class="tag">Health</a></li>
										<li><a href="#" class="tag">Family</a></li>
										<li><a href="#" class="tag">Tips</a></li>
										<li><a href="#" class="tag">Shedule</a></li>
										<li><a href="#" class="tag">Treatment</a></li>
										<li><a href="#" class="tag">Dr</a></li>
										<li><a href="#" class="tag">Clinic</a></li>
										<li><a href="#" class="tag">Online</a></li>
										<li><a href="#" class="tag">Health Care</a></li>
										<li><a href="#" class="tag">Consulting</a></li>
										<li><a href="#" class="tag">Doctors</a></li>
										<li><a href="#" class="tag">Neurology</a></li>
										<li><a href="#" class="tag">Dentists</a></li>
										<li><a href="#" class="tag">Specialist</a></li>
										<li><a href="#" class="tag">Doccure</a></li>
									</ul>
								</div>
							</div>-->
							<!-- /Tags -->
							
						</div>
						<!-- /Blog Sidebar -->

					</div>
             	</div>

			</div>		
			<!-- /Page Content -->


		@include('website.footer')

		</div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Slick JS -->
		<script src="{{asset('assets/js/slick.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>