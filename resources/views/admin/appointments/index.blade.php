@extends('admin.layouts.app')

@section('content')

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-title">Appointments</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Appointments</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->

	<div class="row">
	    <div class="col-md-12">
	        @include('inc.messages')
	    </div>
	</div>


	<div class="row">
		<div class="col-md-12">
		
			<!-- Recent Orders -->
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="datatable table table-hover table-center mb-0">
							<thead>
								<tr>
									<th>Doctor Name</th>
									<th>Speciality</th>
									<th>Patient Name</th>
									<th>Apointment Time</th>
									<th>Status</th>
									<th class="text-right">Amount</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($appointments as $appointment)
								<tr>
									<td>
										<h2 class="table-avatar">
											<a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{url('/storage/profile_images/'.$appointment->doctor->profile_picture ) }}" alt="User Image"></a>
											<a href="#">Dr. {{$appointment->doctor->name}} {{$appointment->doctor->firstname}}</a>
										</h2>
									</td>
									<td>{{$appointment->doctor->speciality->title}}</td>
									<td>
										<h2 class="table-avatar">
											<a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{url('/storage/profile_images/'.$appointment->patient->profile_picture ) }}" alt="User Image"></a>
											<a href="#">{{$appointment->patient->name}} {{$appointment->patient->firstname}} </a>
										</h2>
									</td>
									<td>{{$appointment->date_apt}} <span class="text-primary d-block">{{$appointment->begin_time}} - {{$appointment->end_time}}</span></td>
									<td>
										<div class="status-toggle">
											<input type="checkbox" id="status_1" class="check" checked>
											<label for="status_1" class="checktoggle">checkbox</label>
										</div>
									</td>
									<td class="text-right">
										${{$appointment->apt_amount}}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- /Recent Orders -->
			
		</div>
	</div>
@endsection