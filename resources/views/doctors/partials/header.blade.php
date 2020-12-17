<!-- Header -->
	<header class="header">
		<nav class="navbar navbar-expand-lg header-nav">
			<div class="navbar-header">
				<a id="mobile_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				<a href="{{route('home')}}" class="navbar-brand logo">
					<img src="{{asset('assets/img/logo_aah.png') }}" class="img-fluid" alt="Logo">
				</a>
			</div>

			<div class="main-menu-wrapper" style="margin: auto;">
				<div class="menu-header">
					<a href="{{route('home')}}" class="menu-logo">
						<img src="{{asset('assets/img/logo_aah.png') }}" class="img-fluid" alt="Logo">
					</a>
					<a id="menu_close" class="menu-close" href="javascript:void(0);">
						<i class="fas fa-times"></i>
					</a>
				</div>

				<ul class="main-nav">

					<li class="{{ Request::routeIs('home') ? 'active' : '' }}">
						<a href="{{route('home')}}">Home</a>
					</li>

					<li class="">
						<a href="#">Pharmacies</a>
					</li>

					<!--<li class="has-submenu">
						<a href="">Doctors <i class="fas fa-chevron-down"></i></a>
						<ul class="submenu">
							<li><a href="{{route('doctor_dashboard')}}">Doctor Dashboard</a></li>
							<li><a href="{{route('doctor_my_appointments')}}">Appointments</a></li>
							<li class="has-submenu">
								<a href="#">Schedule Timing</a>
								<ul class="submenu">
									<li><a href="{{route('schedules.index')}}">List</a></li>
									<li><a href="{{route('schedules.create')}}">Add</a></li>
								</ul>
							</li>
							<li><a href="{{route('doctor_my_patients')}}">Patients List</a></li>
							<li><a href="{{route('chat')}}">Chat</a></li>
							<li><a href="{{route('video_chat')}}">Video Chat</a></li>
							<li><a href="{{route('doctor_my_invoices')}}">Invoices</a></li>
							<li><a href="{{route('doctor_profile_setting')}}">Profile Settings</a></li>
							<li><a href="{{route('doctor_reviews')}}">Reviews</a></li>
							<li class="has-submenu">
								<a href="#">My Posts</a>
								<ul class="submenu">
									<li><a href="{{route('posts.index')}}">List</a></li>
									<li><a href="{{route('posts.create')}}">New</a></li>
								</ul>
							</li>
							<li class="has-submenu">
								<a href="#">Diseases</a>
								<ul class="submenu">
									<li><a href="{{route('diseases.index')}}">List</a></li>
									<li><a href="{{route('diseases.create')}}">New</a></li>
								</ul>
							</li>

						</ul>
					</li>-->


					<li class="{{ Request::routeIs('blog') ? 'active' : '' }}">
						<a href="{{route('blog')}}">Blog</a>
					</li>

					<li class="{{ Request::routeIs('about') ? 'active' : '' }}">
						<a href="{{route('about')}}">About</a>
					</li>

					<!--<li class="{{ Request::routeIs('services') ? 'active' : '' }}">
						<a href="{{route('services')}}">Services</a>
					</li>-->

					<li class="">
						<a href="{{route('home')}}#download-app">Application</a>
					</li>

					<li class="{{ Request::routeIs('contact') ? 'active' : '' }}">
						<a href="{{route('contact')}}">Contact</a>
					</li>

					<li class="has-submenu">
                        <a href="#!">
                            Langue <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul class="submenu">
                            <li><a class="dropdown-item" href="{{ URL::to('locale/en') }}"><img src="{{asset('assets/img/us.png')}}" width="20px" height="15x"> English</a></li>
                            <li><a class="dropdown-item" href="{{ URL::to('locale/fr') }}"><img src="{{asset('assets/img/fr.jpg')}}" width="20px" height="15x"> French</a></li>
                            <li><a class="dropdown-item" href="{{ URL::to('locale/sw') }}"><img src="{{asset('assets/img/sw.png')}}" width="20px" height="15x"> Swawili</a></li>
                        </ul>
                    </li>

				
				</ul>
			</div>

			<ul class="nav header-navbar-rht">
				<!--<li class="nav-item contact-item">
					<div class="header-contact-img">
						<i class="far fa-hospital"></i>							
					</div>
					<div class="header-contact-detail">
						<p class="contact-header">Contact</p>
						<p class="contact-info-header"> +1 315 369 5943</p>
					</div>
				</li>-->

				<!-- Notifications -->

				<li class="nav-item dropdown logged-item noti-dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<i class="fas fa-bell"></i> <span class="badge badge-pill">3</span>
					</a>
					<div class="dropdown-menu notifications dropdown-menu-right">
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
												<img class="avatar-img rounded-circle" alt="User Image" src="{{asset('assets/img/doctors/doctor-thumb-01.jpg') }}">
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
				<!-- Notifications -->

				<!-- User Menu -->
				<li class="nav-item dropdown has-arrow logged-item">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img">
							<img class="rounded-circle" src="{{asset('assets/img/patients/patient.jpg') }}" width="31" alt="Ryan Taylor">
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="user-header">
							<div class="avatar avatar-sm">
								<img src="{{asset('assets/img/patients/patient.jpg') }}" alt="User Image" class="avatar-img rounded-circle">
							</div>
							<div class="user-text">
								<h6>{{Auth()->user()->name}}</h6>
								<p class="text-muted mb-0">Doctor</p>
							</div>
						</div>

						<a class="dropdown-item" href="{{route('doctor_dashboard')}}">Dashboard</a>

						<a class="dropdown-item" href="{{route('doctor_my_appointments')}}">Appointments</a>

						<a class="dropdown-item" href="{{route('schedules.index')}}">Schedule Timing</a>

						<a class="dropdown-item" href="{{route('doctor_my_patients')}}">Patients List</a>

						<a class="dropdown-item" href="{{route('posts.index')}}">My Posts</a>

						<a class="dropdown-item" href="{{route('doctor_my_invoices')}}">Invoices</a>

						<a class="dropdown-item" href="{{route('doctor_reviews')}}">Reviews</a>

						<a class="dropdown-item" href="{{route('diseases.index')}}">Diseases</a>

						<a class="dropdown-item" href="{{route('chat')}}">Chat</a>

						<a class="dropdown-item" href="{{route('video_chat')}}">Video Chat</a>

						<a class="dropdown-item" href="{{route('doctor_profile_setting')}}">Profile Settings</a>
						
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
						 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
					</div>
				</li>
				<!-- /User Menu -->
			</ul>
		</nav>
	</header>
<!-- /Header -->