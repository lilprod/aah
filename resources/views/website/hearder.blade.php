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
						@guest

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
										<a href="{{route('home')}}">Accueil</a>
									</li>

									<li class="{{ Request::routeIs('our_doctors') ? 'active' : '' }}">
										<a href="{{route('our_doctors')}}">Médecins</a>
									</li>

									<li class="">
										<a href="#">Pharmacies</a>
									</li>

									<li class="{{ Request::routeIs('blog') ? 'active' : '' }}">
										<a href="{{route('blog')}}">Blog</a>
									</li>

									<li class="{{ Request::routeIs('about') ? 'active' : '' }}">
										<a href="{{route('about')}}">À propos</a>
									</li>

									<!--<li class="">
										<a href="{{route('services')}}">Services</a>
									</li>-->

									<li class="">
										<a href="{{route('home')}}#download-app">Application</a>
									</li>

									<li class="{{ Request::routeIs('contact') ? 'active' : '' }}">
										<a href="{{route('contact')}}">Contact</a>
									</li>

									<li class="has-submenu">
			                            <a href="">
			                                Langue <i class="fas fa-chevron-down"></i>
			                            </a>
			                            <ul class="submenu">
			                                <li><a class="dropdown-item" href="{{ URL::to('locale/en') }}"><img src="{{asset('assets/img/us.png')}}" width="20px" height="15x"> English</a></li>
			                                <li><a class="dropdown-item" href="{{ URL::to('locale/fr') }}"><img src="{{asset('assets/img/fr.jpg')}}" width="20px" height="15x"> French</a></li>
			                                <li><a class="dropdown-item" href="{{ URL::to('locale/sw') }}"><img src="{{asset('assets/img/sw.png')}}" width="20px" height="15x"> Swawili</a></li>
			                            </ul>
			                        </li>
									

									{{--@guest('admin') 
																									
										<li>
											<a href="{{route('admin.login')}}" target="_blank">Admin</a>
										</li>
	
									@endguest--}}

									



								</ul>

							</div>

							@guest('admin') 

							<ul class="nav header-navbar-rht">
								<li class="nav-item contact-item">
									<div class="header-contact-img">
										<i class="far fa-hospital"></i>							
									</div>
									<div class="header-contact-detail">
										<p class="contact-header">Contact</p>
										<p class="contact-info-header"> +1 315 369 5943</p>
									</div>
								</li>
								<li class="nav-item">
									<a class="nav-link header-login" href="{{route('login')}}">Login / Signup </a>
								</li>
							</ul>

							@endguest

							@auth('admin')

							 <ul class="nav header-navbar-rht">
								<li class="nav-item contact-item">
									<div class="header-contact-img">
										<i class="far fa-hospital"></i>							
									</div>
									<div class="header-contact-detail">
										<p class="contact-header">Contact</p>
										<p class="contact-info-header"> +1 315 369 5943</p>
									</div>
								</li>

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
												<h6>{{Auth::guard('admin')->user()->name}}</h6>
												<p class="text-muted mb-0">Administrator</p>
											</div>
										</div>
										<a class="dropdown-item" href="{{route('admin.dashboard')}}" target="_blank">Dashboard</a>
										<a class="dropdown-item" href="#">Profile Settings</a>
										<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
	                                                     document.getElementById('logout-form').submit();">Logout</a>
										 <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
	                                        @csrf
	                                    </form>
									</div>
								</li>
							</ul>
							
							@endauth

							
							@else

							

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

									@if(auth()->user()->role_id == 1)

									<li class="">
										<a href="{{route('our_doctors')}}">Médecins</a>
									</li>

									<li class="has-submenu">
										<a href="#!">Patients<i class="fas fa-chevron-down"></i></a>
										<ul class="submenu">
											<li><a href="{{route('dashboard')}}">My Dashboard</a></li>
											<li><a href="{{route('search')}}">Search Doctor</a></li>
											<li><a href="#">Booking</a></li>
											<li><a href="{{ url('my_favourites') }}">Favourites</a></li>
											<li><a href="{{route('search_disease')}}">Disease and Treatment</a></li>
											<li><a href="{{route('chat')}}">Chat</a></li>
											<li><a href="{{route('video_chat')}}">Video Chat</a></li>
											<li><a href="{{route('patient_profile_setting')}}">Profile Settings</a></li>
											<li><a href="{{route('patient_change_password')}}">Change Password</a></li>
										</ul>
									</li>
									@endif

									@if(auth()->user()->role_id == 2)
									<li class="has-submenu">
										<a href="">Doctors <i class="fas fa-chevron-down"></i></a>
										<ul class="submenu">
											<li><a href="{{route('dashboard')}}">Doctor Dashboard</a></li>
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
											<li><a href="#">Invoices</a></li>
											<li><a href="{{route('doctor_profile_setting')}}">Profile Settings</a></li>
											<li><a href="{{route('doctor_change_password')}}">Change Password</a></li>
											<li><a href="#">Reviews</a></li>
											<li class="has-submenu">
												<a href="#">My Posts</a>
												<ul class="submenu">
													<li><a href="{{route('posts.index')}}">List</a></li>
													<li><a href="{{route('posts.create')}}">New</a></li>
												</ul>
											</li>
										</ul>
									</li>
									@endif

									<li class="">
										<a href="#">Pharmacies</a>
									</li>

									<li class="{{ Request::routeIs('blog') ? 'active' : '' }}">
										<a href="{{route('blog')}}">Blog</a>
									</li>

									<li class="{{ Request::routeIs('about') ? 'active' : '' }}">
										<a href="{{route('about')}}">À propos</a>
									</li>

									<!--<li class="">
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
								<li class="nav-item contact-item">
									<div class="header-contact-img">
										<i class="far fa-hospital"></i>							
									</div>
									<div class="header-contact-detail">
										<p class="contact-header">Contact</p>
										<p class="contact-info-header"> +1 315 369 5943</p>
									</div>
								</li>
								<!--<li class="nav-item">
									<a class="nav-link header-login" href="{{route('login')}}">Login / Signup </a>
								</li>-->
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
												@if(auth()->user()->role_id == 1)
													<p class="text-muted mb-0">Patient</p>
												@else
													<p class="text-muted mb-0">Doctor</p>
												@endif
											</div>
										</div>
										<a class="dropdown-item" href="{{route('dashboard')}}" target="_blank">Dashboard</a>
										@if(auth()->user()->role_id == 1)
											<a class="dropdown-item" href="{{route('patient_profile_setting')}}">Profile Settings</a>
										@else
											<a class="dropdown-item" href="{{route('doctor_profile_setting')}}">Profile Settings</a>
										@endif
										<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
	                                                     document.getElementById('logout-form').submit();">Logout</a>
										 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                        @csrf
	                                    </form>
									</div>
								</li>
							</ul>
						@endguest
					<!--<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="index.html" class="menu-logo">
								<img src="assets/img/logo.png" class="img-fluid" alt="Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);">
								<i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">

							
							<li class="active">
								<a href="{{route('home')}}">Home</a>
							</li>
							<li class="has-submenu">
								<a href="">Doctors <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<li><a href="doctor-dashboard.html">Doctor Dashboard</a></li>
									<li><a href="appointments.html">Appointments</a></li>
									<li><a href="schedule-timings.html">Schedule Timing</a></li>
									<li><a href="my-patients.html">Patients List</a></li>
									<li><a href="patient-profile.html">Patients Profile</a></li>
									<li><a href="chat-doctor.html">Chat</a></li>
									<li><a href="invoices.html">Invoices</a></li>
									<li><a href="doctor-profile-settings.html">Profile Settings</a></li>
									<li><a href="reviews.html">Reviews</a></li>
									<li><a href="doctor-register.html">Doctor Register</a></li>
								</ul>
							</li>	
							<li class="has-submenu">
								<a href="">Patients <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<li class="has-submenu">
										<a href="#">Doctors</a>
										<ul class="submenu">
											<li><a href="map-grid.html">Map Grid</a></li>
											<li><a href="map-list.html">Map List</a></li>
										</ul>
									</li>
									<li><a href="search.html">Search Doctor</a></li>
									<li><a href="doctor-profile.html">Doctor Profile</a></li>
									<li><a href="booking.html">Booking</a></li>
									<li><a href="checkout.html">Checkout</a></li>
									<li><a href="booking-success.html">Booking Success</a></li>
									<li><a href="patient-dashboard.html">Patient Dashboard</a></li>
									<li><a href="favourites.html">Favourites</a></li>
									<li><a href="chat.html">Chat</a></li>
									<li><a href="profile-settings.html">Profile Settings</a></li>
									<li><a href="change-password.html">Change Password</a></li>
								</ul>
							</li>	
							<li class="has-submenu">
								<a href="">Pages <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<li><a href="voice-call.html">Voice Call</a></li>
									<li><a href="video-call.html">Video Call</a></li>
									<li><a href="search.html">Search Doctors</a></li>
									<li><a href="calendar.html">Calendar</a></li>
									<li><a href="components.html">Components</a></li>
									<li class="has-submenu">
										<a href="invoices.html">Invoices</a>
										<ul class="submenu">
											<li><a href="invoices.html">Invoices</a></li>
											<li><a href="invoice-view.html">Invoice View</a></li>
										</ul>
									</li>
									<li><a href="blank-page.html">Starter Page</a></li>
									<li><a href="login.html">Login</a></li>
									<li><a href="register.html">Register</a></li>
									<li><a href="forgot-password.html">Forgot Password</a></li>
								</ul>
							</li>
							<li class="has-submenu">
								<a href="">Blog <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<li><a href="blog-list.html">Blog List</a></li>
									<li><a href="blog-grid.html">Blog Grid</a></li>
									<li><a href="blog-details.html">Blog Details</a></li>
								</ul>
							</li>
							<li>
								<a href="{{route('admin.login')}}" target="_blank">Admin</a>
							</li>
							<li class="login-link">
								<a href="{{route('login')}}">Login / Signup</a>
							</li>
						</ul>		 
					</div>		 
					<ul class="nav header-navbar-rht">
						<li class="nav-item contact-item">
							<div class="header-contact-img">
								<i class="far fa-hospital"></i>							
							</div>
							<div class="header-contact-detail">
								<p class="contact-header">Contact</p>
								<p class="contact-info-header"> +1 315 369 5943</p>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link header-login" href="{{route('login')}}">Login / Signup </a>
						</li>
					</ul>-->
				</nav>
			</header>
			<!-- /Header -->