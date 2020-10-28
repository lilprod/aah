<div class="modal-header">
	<h5 class="modal-title">Appointment Details</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
<div class="modal-body">
	<ul class="info-details">
		<li>
			<div class="details-header">
				<div class="row">
					<div class="col-md-6">
						<span class="title">#APT00{{$appointment->id}} </span>
						<span class="text">{{$appointment->date_apt}} {{$appointment->begin_time}}</span>
					</div>
					<div class="col-md-6">
						<div class="text-right">
							@if($appointment->status == 0)
							<button type="button" class="btn bg-warning-light btn-sm" id="topup_status">Pending</button>
							@endif
							@if($appointment->status == 1)
							<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Confirmed</button>
							@endif
							@if($appointment->status == 2)
							<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Cancelled</button>
							@endif
							@if($appointment->status == 3)
							<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Completed</button>
							@endif
						</div>
					</div>
				</div>
			</div>
		</li>

		<li>
			<span class="title">Status:</span>
			@if($appointment->status == 0)
			<span class="text">Pending</span>
			@endif
			@if($appointment->status == 1)
			<span class="text">Confirmed</span>
			@endif
			@if($appointment->status == 2)
			<span class="text">Cancelled</span>
			@endif
			@if($appointment->status == 3)
			<span class="text">Completed</span>
			@endif
		</li>

		@if($appointment->confirm_date != '')
		<li>
			<span class="title">Confirm Date:</span>
			<span class="text">{{$appointment->confirm_date}}</span>
		</li>
		@endif
		<li>
			<span class="title">Paid Amount</span>
			<span class="text">${{$appointment->apt_amount}}</span>
		</li>
	</ul>
</div>