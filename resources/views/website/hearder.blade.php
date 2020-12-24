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

									<li class="nav-item">
										<a class="nav-link header-login" href="{{route('login')}}">Login / Signup </a>
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
								<!--<li class="nav-item">
									<a class="nav-link header-login" href="{{route('login')}}">Login / Signup </a>
								</li>
								<li class="nav-item contact-item">
									<div class="header-contact-img">
										<i class="far fa-hospital"></i>							
									</div>
									<div class="header-contact-detail">
										<p class="contact-header">Contact</p>
										<p class="contact-info-header"> +1 315 369 5943</p>
									</div>
								</li>-->
								
							</ul>

							@endguest

							@auth('admin')

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

									@endif

									{{-- @if(auth()->user()->role_id == 1)

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
									@endif --}}

									{{-- @if(auth()->user()->role_id == 2)
									<li class="has-submenu">
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
									@endif --}}

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
								<!--<li class="nav-item contact-item">
									<div class="header-contact-img">
										<i class="far fa-hospital"></i>							
									</div>
									<div class="header-contact-detail">
										<p class="contact-header">Contact</p>
										<p class="contact-info-header"> +1 315 369 5943</p>
									</div>
								</li>-->
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
										
										@if(auth()->user()->role_id == 1)
											<a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a>

											<a class="dropdown-item" href="{{route('search')}}">Search Doctor</a>

											<a class="dropdown-item" href="{{route('our_doctors')}}">Booking</a>

											<a class="dropdown-item" href="{{ url('my_favourites') }}">Favourites</a>

											<a class="dropdown-item" href="{{route('chat')}}">Chat</a>

											<a class="dropdown-item" href="{{route('video_chat')}}">Video Chat</a>

											<a class="dropdown-item" href="{{route('search_disease')}}">Disease and Treatment</a>

											<a class="dropdown-item" href="{{route('patient_change_password')}}">Change Password</a>
											<a class="dropdown-item" href="{{route('patient_profile_setting')}}">Profile Settings</a>
										@else
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
				</nav>
			</header>
			<!-- /Header -->