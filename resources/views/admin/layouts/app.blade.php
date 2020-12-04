<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <!-- CSRF Token -->
    	<meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin AAH+ - Dashboard</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png') }}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('admin/assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">

		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{asset('admin/assets/css/feathericon.min.css') }}">
		
		<link rel="stylesheet" href="{{asset('admin/assets/plugins/morris/morris.css') }}">

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('admin/assets/css/select2.min.css') }}">

		<!-- Datatables CSS -->
		<link rel="stylesheet" href="{{asset('admin/assets/plugins/datatables/datatables.min.css') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('admin/assets/css/style.css') }}">

        <link href="{{asset('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="{{route('admin.dashboard')}}" class="logo">
						<img src="{{asset('admin/assets/img/logo_aah.png')}}" alt="Logo">
					</a>
					<a href="{{route('admin.dashboard')}}" class="logo logo-small">
						<img src="{{asset('admin/assets/img/logo_small.png')}}" alt="Logo" width="30" height="30">
					</a>
                </div>
				<!-- /Logo -->
				
				<a href="javascript:void(0);" id="toggle_btn">
					<i class="fe fe-text-align-left"></i>
				</a>
				
				<div class="top-nav-search">
					<form>
						<input type="text" class="form-control" placeholder="Search here">
						<button class="btn" type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
				
				<!-- Mobile Menu Toggle -->
				<a class="mobile_btn" id="mobile_btn">
					<i class="fa fa-bars"></i>
				</a>
				<!-- /Mobile Menu Toggle -->
				
				<!-- Header Right Menu -->
				<ul class="nav user-menu">

					<!-- Notifications -->
					<li class="nav-item dropdown noti-dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fe fe-bell"></i> <span class="badge badge-pill">3</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									<li class="notification-message">
										<a href="#">
											<div class="media">
												<span class="avatar avatar-sm">
													<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('admin/assets/img/doctors/doctor-thumb-01.jpg')}}">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title">Dr. Ruby Perrin</span> Schedule <span class="noti-title">her appointment</span></p>
													<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="#">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->
					
					<!-- User Menu -->
					<li class="nav-item dropdown has-arrow">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img"><img class="rounded-circle" src="{{url('/storage/profile_images/'.auth()->user()->profile_picture ) }}" width="31" alt="Ryan Taylor"></span>
						</a>
						<div class="dropdown-menu">
							<div class="user-header">
								<div class="avatar avatar-sm">
									<img src="{{url('/storage/profile_images/'.auth()->user()->profile_picture ) }}" alt="User Image" class="avatar-img rounded-circle">
								</div>
								<div class="user-text">
									<h6>{{Auth()->user()->name}}</h6>
									<p class="text-muted mb-0">Administrator</p>
								</div>
							</div>
							<a class="dropdown-item" href="#">My Profile</a>
							<a class="dropdown-item" href="#">Settings</a>
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                             <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
						</div>
					</li>
					<!-- /User Menu -->
					
				</ul>
				<!-- /Header Right Menu -->
				
            </div>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li class="active"> 
								<a href="{{route('admin.dashboard')}}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
							</li>

							<li> 
								<a href="{{route('home')}}" target="_blank"><i class="fe fe-arrow-left"></i> <span>Back to website</span></a>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-users"></i> <span> Administrators </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('users.index')}}">Administrators </a></li>
									<li><a href="{{route('users.create')}}">New </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-key"></i> <span> Permissions </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('permissions.index')}}">Permissions </a></li>
									<li><a href="{{route('permissions.create')}}">New </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-lock"></i> <span> Roles </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('roles.index')}}">Roles </a></li>
									<li><a href="{{route('roles.create')}}">New </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Blog </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('admin.posts')}}"> Blog </a></li>
									<li><a href="{{route('admin_posts_create')}}"> Add Blog </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Diseases </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('admin.diseases')}}"> Diseases </a></li>
									<li><a href="{{route('admin_diseases_create')}}"> Add Disease </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-vector"></i> <span> Drugs </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('drugs.index')}}">Drugs </a></li>
									<li><a href="{{route('drugs.create')}}">New </a></li>
								</ul>
							</li>


							<li class="submenu">
								<a href="#"><i class="fe fe-vector"></i> <span> Drugs Types</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('drugtypes.index')}}">Drugs Types </a></li>
									<li><a href="{{route('drugtypes.create')}}">New </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-vector"></i> <span> Prescriptions Types</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('prescriptiontypes.index')}}">Prescriptions Types </a></li>
									<li><a href="{{route('prescriptiontypes.create')}}">New </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-vector"></i> <span> Services </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('services.index')}}">Services </a></li>
									<li><a href="{{route('services.create')}}">New </a></li>
								</ul>
							</li>


							<li class="submenu">
								<a href="#"><i class="fe fe-vector"></i> <span> Specialities </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('specialities.index')}}">Specialities </a></li>
									<li><a href="{{route('specialities.create')}}">New </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-vector"></i> <span> Categories </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('categories.index')}}">Categories </a></li>
									<li><a href="{{route('categories.create')}}">New </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-user-plus"></i> <span> Doctors </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('doctors.index')}}">Doctors </a></li>
									<li><a href="{{route('doctors.create')}}">New </a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="fe fe-user-plus"></i> <span> Patients </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{route('patients.index')}}">Patients </a></li>
									<li><a href="{{route('patients.create')}}">New </a></li>
								</ul>
							</li>

							<li> 
								<a href="{{route('admin_appointments')}}"><i class="fe fe-layout"></i> <span>Appointments</span></a>
							</li>
							
							
							<li> 
								<a href="{{route('admin.reviews')}}"><i class="fe fe-star-o"></i> <span>Reviews</span></a>
							</li>
							<li> 
								<a href="{{route('admin_payments')}}"><i class="fe fe-activity"></i> <span>Transactions</span></a>
							</li>
							<li> 
								<a href="#!"><i class="fe fe-vector"></i> <span>Settings</span></a>
							</li>
							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Reports</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="#!">Invoice Reports</a></li>
								</ul>
							</li>
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
					
					@yield('content')
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
        <!-- jQuery -->
        <script src="{{asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>

        <script src="{{ asset('ckeditor/ckeditor.js')}}"></script> 

		<script> CKEDITOR.replace('article-ckeditor'); </script>
		<script> CKEDITOR.replace('article-ckeditor1'); </script>

        @stack('scripts')
		@stack('review')
		@stack('user')
		@stack('permission')
		@stack('role')
		@stack('speciality')
		@stack('service')
		@stack('category')
		@stack('post')
		@stack('patient')
		@stack('doctor')
		@stack('edit_post')
		@stack('add_post')
		@stack('listing_post')
		@stack('edit_disease')
		@stack('add_disease')
		@stack('listing_disease')
		@stack('pending_post')

        <!-- Bootstrap Core JS -->
        <script src="{{asset('admin/assets/js/popper.min.js') }}"></script>

        <script src="{{asset('admin/assets/js/bootstrap.min.js') }}"></script>

        <script src="{{asset('js/star-rating.js') }}" type="text/javascript"></script>
		<!-- /Main Wrapper -->
		
		<!-- Slimscroll JS -->
        <script src="{{asset('admin/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

        <!-- Select2 JS -->
		<script src="{{asset('admin/assets/js/select2.min.js') }}"></script>

		<!-- Datatables JS -->
		<script src="{{asset('/admin/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
		<script src="{{asset('/admin/assets/plugins/datatables/datatables.min.js') }}"></script>

		<script type="text/javascript">

        /*$.extend( true, $.fn.dataTable.defaults, {
        	"searching" : true
        });

        $('.datatable').dataTable();

        var $table=$('.datatable').dataTable({
               "searching" : true,
            });

    	$table.fnDestroy();*/

        /*$.extend( true, $.fn.dataTable.defaults, {
			"search": true,
        });*/
	       
            /*$('.datatable').dataTable( {
				"searching": true,
			});*/

			/*var table = $('.datatable').DataTable();

			table.destroy();

			table = $('.datatable').DataTable({
			        "searching" : true
			});*/

			 
			/*$('.datatable').dataTable( {
			    "searching" : true
			} );*/

		</script>
		
		<!-- Custom JS -->
		<script  src="{{asset('admin/assets/js/script.js') }}"></script>
    </body>
</html>