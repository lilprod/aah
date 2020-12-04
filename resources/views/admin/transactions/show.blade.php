@extends('admin.layouts.app')

@section('content')
	<!-- Invoice Container -->
		<div class="invoice-container">
			
			<div class="row">
				<div class="col-sm-6 m-b-20">
					<img alt="Logo" class="inv-logo img-fluid" src="{{asset('assets/img/logo_aah.png') }}">
				</div>
				<div class="col-sm-6 m-b-20">
					<div class="invoice-details">
						<h3 class="text-uppercase">Invoice #INV-0001</h3>
						<ul class="list-unstyled mb-0">
							<li>Date: <span>March 12, 2019</span></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 m-b-20">
					<ul class="list-unstyled mb-0">
						<li>Doccure Hospital</li>
						<li>3864 Quiet Valley Lane,</li>
						<li>Sherman Oaks, CA, 91403</li>
						<li>GST No:</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 col-lg-7 col-xl-8 m-b-20">
					<h6>Invoice to</h6>
					<ul class="list-unstyled mb-0">
						<li><h5 class="mb-0"><strong>Charlene Reed</strong></h5></li>
						<li>4417 Goosetown Drive</li>
						<li>Taylorsville, NC, 28681</li>
						<li>United States</li>
						<li>8286329170</li>
						<li><a href="#">charlenereed@example.com</a></li>
					</ul>
				</div>
				<div class="col-sm-6 col-lg-5 col-xl-4 m-b-20">
					<h6>Payment Details</h6>
					<ul class="list-unstyled invoice-payment-details mb-0">
						<li><h5>Total Due: <span class="text-right">$200</span></h5></li>
						<li>Bank name: <span>Profit Bank Europe</span></li>
						<li>Country: <span>United Kingdom</span></li>
						<li>City: <span>London E1 8BF</span></li>
						<li>Address: <span>3 Goodman Street</span></li>
						<li>IBAN: <span>KFH37784028476740</span></li>
						<li>SWIFT code: <span>BPT4E</span></li>
					</ul>
				</div>
			</div>
			
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>Description</th>
							<th class="text-center">Quantity</th>
							<!--<th class="text-center">VAT</th>-->
							<th class="text-right">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>General Consultation</td>
							<td class="text-center">1</td>
							<!--<td class="text-center">$0</td>-->
							<td class="text-right">${{$payment->apt_amount }}</td>
						</tr>
						<!--<tr>
							<td>Video Call Booking</td>
							<td class="text-center">1</td>
							<td class="text-center">$0</td>
							<td class="text-right">$250</td>
						</tr>-->
					</tbody>
				</table>
			</div>
			
			<div>
				<div class="row invoice-payment">
					<div class="col-sm-7">
					</div>
					<div class="col-sm-5">
						<div class="m-b-20">
							<h6>Total due</h6>
							<div class="table-responsive no-border">
								<table class="table mb-0">
									<tbody>
										<!--<tr>
											<th>Subtotal:</th>
											<td class="text-right">$250</td>
										</tr>
										<tr>
											<th>Tax: <span class="text-regular">(25%)</span></th>
											<td class="text-right">$50</td>
										</tr>-->
										<tr>
											<th>Total:</th>
											<td class="text-right text-primary"><h5>${{$payment->apt_amount }}</h5></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="invoice-info">
					<h5>Other information</h5>
					<p class="text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum ligula, cursus blandit risus. Maecenas eget metus non tellus dignissim aliquam ut a ex. Maecenas sed vehicula dui, ac suscipit lacus. Sed finibus leo vitae lorem interdum, eu scelerisque tellus fermentum. Curabitur sit amet lacinia lorem. Nullam finibus pellentesque libero.</p>
				</div>
			</div>


			
		</div>

		<div class="col-lg-8 offset-lg-2">
							<a class="btn btn-primary" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i> Back</a>
						</div>
		<!-- /Invoice Container -->
@endsection