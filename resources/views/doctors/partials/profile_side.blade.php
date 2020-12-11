<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

	<!-- Profile Sidebar -->
	<div class="profile-sidebar">
		<div class="widget-profile pro-widget-content">
			<div class="profile-info-widget">
				<a href="#" class="booking-doc-img">
					<img src="{{url('/storage/profile_images/'.auth()->user()->profile_picture ) }}" alt="User Image">
				</a>
				<div class="profile-det-info">
					<h3>Dr. {{ auth()->user()->name }} {{ auth()->user()->firstname }}</h3>
					@if(auth()->user()->doctor()->speciality != '')
					<div class="patient-details">
						<h5 class="mb-0">{{ auth()->user()->doctor()->speciality->title}}</h5>
					</div>
					@endif
				</div>
			</div>
		</div>
		<div class="dashboard-widget">
			<nav class="dashboard-menu">
				<ul>
					<li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
						<a href="{{route('dashboard')}}">
							<i class="fas fa-columns"></i>
							<span>Dashboard</span>
						</a>
					</li>

					<li class="{{ Request::routeIs('doctor_my_appointments') ? 'active' : '' }}">
						<a href="{{route('doctor_my_appointments')}}">
							<i class="fas fa-calendar-check"></i>
							<span>Appointments</span>
						</a>
					</li>

					<li class="{{ Request::routeIs('doctor_my_patients') ? 'active' : '' }}">
						<a href="{{route('doctor_my_patients')}}">
							<i class="fas fa-user-injured"></i>
							<span>My Patients</span>
						</a>
					</li>
					<li>
						<a href="{{route('schedules.index')}}">
							<i class="fas fa-hourglass-start"></i>
							<span>Schedule Timings</span>
						</a>
					</li>

					<li class="{{ Request::routeIs('doctor_my_invoices') ? 'active' : '' }}">
						<a href="{{route('doctor_my_invoices')}}">
							<i class="fas fa-file-invoice"></i>
							<span>Invoices</span>
						</a>
					</li>

					<li class="{{ Request::routeIs('doctor_reviews') ? 'active' : '' }}">
						<a href="{{route('doctor_reviews')}}">
							<i class="fas fa-star"></i>
							<span>Reviews</span>
						</a>
					</li>
					<li>
						<a href="{{route('chat')}}">
							<i class="fas fa-comments"></i>
							<span>Message</span>
							@if(auth()->user()->allChatMsg())
								<small class="unread-msg">{{ auth()->user()->allChatMsg() }}</small>
							@endif
						</a>
					</li>

					<li>
						<a href="{{route('posts.index')}}">
							<i class="fas fa-folder"></i>
							<span>My Posts</span>
						</a>
					</li>

					<li>
						<a href="{{route('diseases.index')}}">
							<i class="fas fa-folder"></i>
							<span>Diseases</span>
						</a>
					</li>

					<li class="{{ Request::routeIs('doctor_profile_setting') ? 'active' : '' }}">
						<a href="{{route('doctor_profile_setting')}}">
							<i class="fas fa-user-cog"></i>
							<span>Profile Settings</span>
						</a>
					</li>
					<!--<li>
						<a href="social-media.html">
							<i class="fas fa-share-alt"></i>
							<span>Social Media</span>
						</a>
					</li>-->
					<li class="{{ Request::routeIs('doctor_change_password') ? 'active' : '' }}">
						<a href="{{route('doctor_change_password')}}">
							<i class="fas fa-lock"></i>
							<span>Change Password</span>
						</a>
					</li>

					<li class="">
						<a href="{{route('signatures.index')}}">
							<i class="fas fa-pen"></i>
							<span>Signature</span>
						</a>
					</li>

					<li>
						<a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
							<i class="fas fa-sign-out-alt"></i>
							<span>Logout</span>
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- /Profile Sidebar -->
	
</div>