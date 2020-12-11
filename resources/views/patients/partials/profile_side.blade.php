<!-- Profile Sidebar -->
<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
	<div class="profile-sidebar">
		<div class="widget-profile pro-widget-content">
			<div class="profile-info-widget">
				<a href="#" class="booking-doc-img">
					<img src="{{url('/storage/profile_images/'.auth()->user()->profile_picture ) }}" alt="User Image">
				</a>
				<div class="profile-det-info">
					<h3>{{Auth()->user()->name}} {{Auth()->user()->firstname}}</h3>
					<div class="patient-details">

						{{--@if(auth()->user()->patient()->birth_date != '') 
							@php
								$birthday = new DateTime(auth()->user()->patient()->birth_date);
							    $currentDate = new DateTime(date("Y-m-d"));
							    $interval = $birthday->diff($currentDate);
							    $age= $interval->format('%Y');
							@endphp
							<h5><i class="fas fa-birthday-cake"></i> {{auth()->user()->patient()->birth_date}}, {{$age}} years</h5>
						@endif--}}
						<!--<h5><i class="fas fa-birthday-cake"></i> 24 Jul 1983, 38 years</h5>-->
						@if( Auth()->user()->address != '')
							<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> {{Auth()->user()->address}}</h5>
						@endif
					</div>
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

					<li class="{{ Request::routeIs('my_favourites') ? 'active' : '' }}">
						<a href="{{ url('my_favourites') }}">
							<i class="fas fa-bookmark"></i>
							<span>Favourites</span>
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

					<li class="{{ Request::routeIs('search_disease') ? 'active' : '' }}">
						<a href="{{route('search_disease')}}">
							<i class="fas fa-search"></i>
							<span>Search Disease</span>
						</a>
					</li>


					<li class="{{ Request::routeIs('patient_profile_setting') ? 'active' : '' }}">
						<a href="{{route('patient_profile_setting')}}">
							<i class="fas fa-user-cog"></i>
							<span>Profile Settings</span>
						</a>
					</li>
					
					<li class="{{ Request::routeIs('patient_change_password') ? 'active' : '' }}">
						<a href="{{route('patient_change_password')}}">
							<i class="fas fa-lock"></i>
							<span>Change Password</span>
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
</div>
<!-- / Profile Sidebar -->