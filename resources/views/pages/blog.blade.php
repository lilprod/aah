<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Telemed AAH - Blog</title>
		
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
									<li class="breadcrumb-item active" aria-current="page">Blog </li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Blog <span style="color: #26a9e166">+</span></h2>
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

							<!-- Blog Post -->
							@foreach($posts as $post)
							<div class="blog">
								<div class="blog-image">
									<a href="#"><img class="img-fluid" src="{{url('/storage/cover_images/'.$post->cover_image ) }}" alt="Post Image"></a>
									<!--<div class="video">
										<iframe src="https://www.youtube.com/embed/nuVqJ_OriR8?rel=0&amp;controls=0&amp;showinfo=0" width="940" allowfullscreen></iframe>
									</div>-->
								</div>
								<h3 class="blog-title"><a href="{{$post->getLink()}}">{{$post->title}}</a></h3>
								<div class="blog-info clearfix">
									<div class="post-left">
										<ul>
											<li>
												<div class="post-author">
													<a href="#"><img src="{{url('/storage/profile_images/'.$post->author_image ) }}" alt="Post Author"> <span>Dr. {{$post->author}}</span></a>
												</div>
											</li>
											<li><i class="far fa-clock"></i> {{ $post->created_at->format('m/d/Y') }}</li>
											<!--<li><i class="far fa-comments"></i>12 Comments</li>-->
											<li><i class="fa fa-tags"></i>{{$post->category->title}}</li>
										</ul>
									</div>
								</div>
								<div class="blog-content">
									<p>{!! \Illuminate\Support\Str::limit($post->body, 500, '...') !!}</p>
									<a href="{{$post->getLink()}}" class="read-more">Read More</a>
								</div>
							</div>

							@endforeach
							<!-- /Blog Post -->


							<!-- Blog Pagination -->
							<div class="row">
								<div class="col-md-12">
									{{$posts->links()}}
									<!--<div class="blog-pagination">

										<nav>

											<ul class="pagination justify-content-center">
												<li class="page-item disabled">
													<a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>
												</li>
												<li class="page-item">
													<a class="page-link" href="#">1</a>
												</li>
												<li class="page-item active">
													<a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
												</li>
												<li class="page-item">
													<a class="page-link" href="#">3</a>
												</li>
												<li class="page-item">
													<a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
												</li>
											</ul>
										</nav>
									</div>-->
								</div>
							</div>
							<!-- /Blog Pagination -->


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

										@foreach( $categories as $category)
											<li><a href="{{$category->getLink()}}">{{$category->title}}<span><!--(62)--></span></a></li>
										@endforeach
									</ul>
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

		<!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
		
		<!-- Slick JS -->
		<script src="{{asset('assets/js/slick.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>