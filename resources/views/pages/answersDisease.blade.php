<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - Diseases</title>
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

			@include('website.hearder')

			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Diseases</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Diseases</h2>
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

							@if($nb == 0)
								<div class="card">
									<div class="card-body">
										@include('inc.messages')

										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<strong>Error!</strong> No <a href="#" class="alert-link">Disease</a>  found for your query. Please try to search again! 
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									</div>
								</div>

							@else
						
							<div class="row blog-grid-row">
								@foreach($diseases as $disease)
									<div class="col-md-6 col-sm-12">
									
										<!-- Blog Post -->
										<div class="blog grid-blog">
											<div class="blog-image">
												<a href="#"><img class="img-fluid" src="{{url('/storage/diseases/'.$disease->cover_image ) }}" alt="Post Image"></a>
											</div>
											<div class="blog-content">
												<ul class="entry-meta meta-item">
													<li>
														<div class="post-author">
															<a href="#"><img src="{{url('/storage/profile_images/'.$disease->user->profile_picture ) }}" alt="Post Author"> <span>Dr. {{$disease->user->name}}</span></a>
														</div>
													</li>
													<li><i class="far fa-clock"></i> 4 Dec 2019</li>
												</ul>
												<h3 class="blog-title"><a href="#">{{$disease->title}}</a></h3>
												<p class="mb-0">{!! \Illuminate\Support\Str::limit($disease->description, 50, '...') !!}</p>
											</div>
										</div>
										<!-- /Blog Post -->
										
									</div>
								@endforeach
								</div>
							@endif

							<!-- Blog Pagination -->
							<div class="row">
								<div class="col-md-12">
									<a class="btn btn-primary" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i> Back</a>
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
							<!--<div class="card search-widget">
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
							</div>-->
							<!-- /Search -->

							<!-- Latest Posts -->
							<!--<div class="card post-widget">
								<div class="card-header">
									<h4 class="card-title">Latest Posts</h4>
								</div>
								<div class="card-body">
									<ul class="latest-posts">
										<li>
											<div class="post-thumb">
												<a href="blog-details.html">
													<img class="img-fluid" src="assets/img/blog/blog-thumb-01.jpg" alt="">
												</a>
											</div>
											<div class="post-info">
												<h4>
													<a href="blog-details.html">Doccure – Making your clinic painless visit?</a>
												</h4>
												<p>4 Dec 2019</p>
											</div>
										</li>
									</ul>
								</div>
							</div>-->
							<!-- /Latest Posts -->

						</div>
						<!-- /Blog Sidebar -->
						
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
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>