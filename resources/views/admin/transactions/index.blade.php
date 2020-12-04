@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-title">Transactions</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item active">Transactions</li>
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
		<div class="col-sm-12">
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="datatable table table-hover table-center mb-0">
							<thead>
								<tr>
									<th>Invoice Number</th>
									<th>Patient ID</th>
									<th>Patient Name</th>
									<th>Total Amount</th>
									<th class="text-center">Status</th>
									<th class="text-right">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($payments as $payment)
								<tr>
									<td><a href="#">#IN000{{$payment->id}}</td>
									<td>#PT00{{$payment->patient_id}}</td>
									<td>
										<h2 class="table-avatar">
											<a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="assets/img/patients/patient1.jpg" alt="User Image"></a>
											<a href="#">{{$payment->patient->name}} {{$payment->patient->firstname}} </a>
										</h2>
									</td>
									<td>${{$payment->apt_amount}}</td>
									<td class="text-center">
										@if($payment->status == 0)
										<span class="badge badge-pill bg-danger inv-badge">Not Paid</span>
										@else
										<span class="badge badge-pill bg-success inv-badge">Paid</span>
										@endif
									</td>
									<td class="text-right">
										<div class="actions">
											<!--<a class="btn btn-sm bg-danger-light" data-toggle="modal" href="#delete_modal">
												<i class="fe fe-trash"></i> Delete
											</a>-->

											<a href="{{route('admin_payments_show', $payment->id)}}" class="btn btn-sm bg-info-light">
												<i class="far fa-eye"></i> View
											</a>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>			
	</div>


	<!-- Delete Modal -->
		<div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content">
				<!--	<div class="modal-header">
						<h5 class="modal-title">Delete</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>-->
					<div class="modal-body">
						<div class="form-content p-2">
							<h4 class="modal-title">Delete</h4>
							<p class="mb-4">Are you sure want to delete?</p>
							<button type="button" class="btn btn-primary">Save </button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- /Delete Modal -->
@endsection