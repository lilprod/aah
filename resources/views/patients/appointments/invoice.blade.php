<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - Invoice</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="{{asset('assets/img/favicon.png') }}" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css') }}">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
			@include('website.hearder')
			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Invoice View</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Invoice View <span style="color: #26a9e166">+</span></h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-lg-8 offset-lg-2">
							<div class="invoice-content">
								<div class="invoice-item">
									<div class="row">
										<div class="col-md-6">
											<div class="invoice-logo">
												<img src="{{asset('assets/img/logo_aah.png') }}" alt="logo">
											</div>
										</div>
										<div class="col-md-6">
											<p class="invoice-details">
												<strong>Order:</strong> #00124 <br>
												<strong>Issued:</strong> 20/07/2019
											</p>
										</div>
									</div>
								</div>
								
								<!-- Invoice Item -->
								<div class="invoice-item">
									<div class="row">
										<div class="col-md-6">
											<div class="invoice-info">
												<strong class="customer-text">Invoice From</strong>
												<p class="invoice-details invoice-details-two">
													Dr. {{$payment->doctor->name }} {{$payment->doctor->firstname}} <br>
													{{$payment->doctor->address }},<br>
													{{$payment->doctor->phone_number }} <br>
												</p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="invoice-info invoice-info2">
												<strong class="customer-text">Invoice To</strong>
												<p class="invoice-details">
													{{$payment->patient->name }} {{$payment->patient->firstname}} <br>
													{{$payment->patient->address }}, <br>
													{{$payment->patient->phone_number }} <br>
												</p>
											</div>
										</div>
									</div>
								</div>
								<!-- /Invoice Item -->
								
								<!-- Invoice Item -->
								<div class="invoice-item">
									<div class="row">
										<div class="col-md-12">
											<div class="invoice-info">
												<strong class="customer-text">Payment Method</strong>
												<p class="invoice-details invoice-details-two">
													Debit Card <br>
													XXXXXXXXXXXX-2541 <br>
													HDFC Bank<br>
												</p>
											</div>
										</div>
									</div>
								</div>
								<!-- /Invoice Item -->
								
								<!-- Invoice Item -->
								<div class="invoice-item invoice-table-wrap">
									<div class="row">
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="invoice-table table table-bordered">
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
										</div>
										<div class="col-md-6 col-xl-4 ml-auto">
											<div class="table-responsive">
												<table class="invoice-table-two table">
													<tbody>
													<!--<tr>
														<th>Subtotal:</th>
														<td><span>$350</span></td>
													</tr>
													<tr>
														<th>Discount:</th>
														<td><span>-10%</span></td>
													</tr>-->
													<tr>
														<th>Total Amount:</th>
														<td><span>${{$payment->apt_amount }}</span></td>
													</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!-- /Invoice Item -->

								<br><br>
								<!-- Signature -->
									<div class="row">
										<div class="col-md-12 text-right">
											<div class="signature-wrap">
												<div class="signature">
													<img class="img-fluid" src="{{url('/storage/signatures/'.$payment->doctor->signature->signature_file ) }}" alt="Signature Image">
												</div>
												<div class="sign-name">
													<p class="mb-0">( Dr. {{$payment->doctor->name}} {{$payment->doctor->firstname}} )</p>
													<span class="text-muted">Signature</span>
												</div>
											</div>
										</div>
									</div>
									<!-- /Signature -->
								
								<!-- Invoice Information -->
								<div class="other-info">
									<h4>Other information</h4>
									<p class="text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum ligula, cursus blandit risus. Maecenas eget metus non tellus dignissim aliquam ut a ex. Maecenas sed vehicula dui, ac suscipit lacus. Sed finibus leo vitae lorem interdum, eu scelerisque tellus fermentum. Curabitur sit amet lacinia lorem. Nullam finibus pellentesque libero.</p>
								</div>
								<!-- /Invoice Information -->
								
							</div>
						</div>

						
						<div class="col-lg-8 offset-lg-2">
							<a class="btn btn-primary" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i> Back</a>
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
			<!-- Footer -->
			@include('website.footer')
			<!-- /Footer -->
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/popper.min.js') }}"></script>
		<script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js') }}"></script>
		
	</body>
</html>