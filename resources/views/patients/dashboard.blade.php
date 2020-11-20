<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AAH+ - Patient Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        
        <!-- Favicons -->
        <link type="image/x-icon" href="{{asset('assets/img/favicon.png') }}" rel="icon">
        
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
            @include('patients.partials.header')
            <!-- /Header -->
            
            <!-- Breadcrumb -->
            <div class="breadcrumb-bar">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12 col-12">
                            <nav aria-label="breadcrumb" class="page-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                            <h2 class="breadcrumb-title">Dashboard <span style="color: #26a9e166">+</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->
            
            <!-- Page Content -->
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        
                        <!-- Profile Sidebar -->
                        @include('patients.partials.profile_side')
                        <!-- / Profile Sidebar -->
                        
                        <div class="col-md-7 col-lg-8 col-xl-9">
                            @include('inc.messages')
                            <div class="card">
                                <div class="card-body pt-0">
                                
                                    <!-- Tab Menu -->
                                    <nav class="user-tabs mb-4">
                                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#pat_prescriptions" data-toggle="tab">Prescriptions</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#pat_medical_records" data-toggle="tab"><span class="med-records">Medical Records</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#pat_billing" data-toggle="tab">Billing</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <!-- /Tab Menu -->
                                    
                                    <!-- Tab Content -->
                                    <div class="tab-content pt-0">
                                        
                                        <!-- Appointment Tab -->
                                        <div id="pat_appointments" class="tab-pane fade show active">
                                            <div class="card card-table mb-0">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-center mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Doctor</th>
                                                                    <th>Appt Date</th>
                                                                    <th>Booking Date</th>
                                                                    <th>Amount</th>
                                                                    <th>Follow Up</th>
                                                                    <th>Status</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($appointments as $appointment)
                                                                <tr>
                                                                    <td>
                                                                        <h2 class="table-avatar">
                                                                            <a href="{{route('doctor.profile', $appointment->doctor_id)}}" class="avatar avatar-sm mr-2">
                                                                                <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-01.jpg" alt="User Image">
                                                                            </a>
                                                                            <a href="{{route('doctor.profile', $appointment->doctor_id)}}">Dr. {{$appointment->doctor->name}} <span>{{$appointment->doctor->speciality->title}}</span></a>
                                                                        </h2>
                                                                    </td>
                                                                    <td>{{$appointment->date_apt}} <span class="d-block text-info">{{$appointment->begin_time}}</span></td>
                                                                    <td>{{$appointment->created_at}}</td>
                                                                    <td>${{$appointment->apt_amount}}</td>
                                                                    <td>-</td>
                                                                    <td>
                                                                        @if($appointment->status == 1)
                                                                        <span class="badge badge-pill bg-success-light">Confirm</span>
                                                                        @elseif($appointment->status == 0)
                                                                        <span class="badge badge-pill bg-warning-light">Pending</span>
                                                                        @elseif($appointment->status == 2)
                                                                        <span class="badge badge-pill bg-danger-light">Cancelled</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <div class="table-action">
                                                                            <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                                                <i class="fas fa-print"></i> Print
                                                                            </a>
                                                                            <!--<a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                                                <i class="far fa-eye"></i> View
                                                                            </a>-->
                                                                            <a href="{{route('appointments.show', $appointment->id)}}" class="btn btn-sm bg-info-light" id="show"><i class="far fa-eye"></i> View</a>

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
                                        <!-- /Appointment Tab -->
                                        
                                        <!-- Prescription Tab -->
                                        <div class="tab-pane fade" id="pat_prescriptions">
                                            <div class="card card-table mb-0">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-center mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Date </th>
                                                                    <th>Name</th>                                   
                                                                    <th>Created by </th>
                                                                    <th></th>
                                                                </tr>     
                                                            </thead>
                                                            <tbody>
                                                                @foreach($prescriptions as $prescription)
                                                                <tr>
                                                                    <td>{{$prescription->created_at->format('d/m/Y')}}</td>
                                                                    <td>Prescription</td>
                                                                    <td>
                                                                        <h2 class="table-avatar">
                                                                            <a href="{{route('doctor.profile', $prescription->doctor->id)}}" class="avatar avatar-sm mr-2">
                                                                                <img class="avatar-img rounded-circle" src="{{url('/storage/profile_images/'.$prescription->doctor->profile_picture ) }}" alt="User Image">
                                                                            </a>
                                                                            <a href="{{route('doctor.profile', $prescription->doctor->id)}}">Dr. {{$prescription->doctor->name }} {{$prescription->doctor->firstname}} <span>{{$prescription->doctor->speciality->title}}</span></a>
                                                                        </h2>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <div class="table-action">
                                                                            <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                                                <i class="fas fa-print"></i> Print
                                                                            </a>
                                                                            <a href="{{route('prescriptions.show', $prescription->id)}}" class="btn btn-sm bg-info-light">
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
                                        <!-- /Prescription Tab -->
                                            
                                        <!-- Medical Records Tab -->
                                        <div id="pat_medical_records" class="tab-pane fade">
                                            <div class="card card-table mb-0">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-center mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Date </th>
                                                                    <th>Description</th>
                                                                    <th>Attachment</th>
                                                                    <th>Created</th>
                                                                    <th></th>
                                                                </tr>     
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><a href="javascript:void(0);">#MR-0010</a></td>
                                                                    <td>14 Nov 2019</td>
                                                                    <td>Dental Filling</td>
                                                                    <td><a href="#">dental-test.pdf</a></td>
                                                                    <td>
                                                                        <h2 class="table-avatar">
                                                                            <a href="doctor-profile.html" class="avatar avatar-sm mr-2">
                                                                                <img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-01.jpg" alt="User Image">
                                                                            </a>
                                                                            <a href="doctor-profile.html">Dr. Ruby Perrin <span>Dental</span></a>
                                                                        </h2>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <div class="table-action">
                                                                            <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                                                <i class="far fa-eye"></i> View
                                                                            </a>
                                                                            <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                                                <i class="fas fa-print"></i> Print
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>    
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /Medical Records Tab -->
                                        
                                        <!-- Billing Tab -->
                                        <div id="pat_billing" class="tab-pane fade">
                                            <div class="card card-table mb-0">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-center mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Invoice No</th>
                                                                    <th>Doctor</th>
                                                                    <th>Amount</th>
                                                                    <th>Paid On</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($payments as $payment)
                                                                <tr>
                                                                    <td>
                                                                        <a href="#">#INV-00{{$payment->id}}</a>
                                                                    </td>
                                                                    <td>
                                                                        <h2 class="table-avatar">
                                                                            <a href="{{route('doctor.profile', $payment->doctor->id)}}" class="avatar avatar-sm mr-2">
                                                                                <img class="avatar-img rounded-circle" src="{{url('/storage/profile_images/'.$payment->doctor->profile_picture ) }}" alt="User Image">
                                                                            </a>
                                                                            <a href="{{route('doctor.profile', $payment->doctor->id)}}">Dr. {{$payment->doctor->name }} {{$payment->doctor->firstname}} <span>{{$payment->doctor->speciality->title}}</span></a>
                                                                        </h2>
                                                                    </td>
                                                                    <td>${{$payment->apt_amount}}</td>
                                                                    <td>{{$payment->created_at->format('d/m/Y')}}</td>
                                                                    <td class="text-right">
                                                                        <div class="table-action">
                                                                            <a href="{{route('invoice.show', $payment->id)}}" class="btn btn-sm bg-info-light">
                                                                                <i class="far fa-eye"></i> View
                                                                            </a>
                                                                            <a href="javascript:void(0);" class="btn btn-sm bg-primary-light">
                                                                                <i class="fas fa-print"></i> Print
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
                                        <!-- /Billing Tab -->
                                        
                                    </div>
                                    <!-- Tab Content -->
                                    
                                </div>
                            </div>
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

        <!-- Appointment Details Modal -->
        <div class="modal details fade custom-modal" id="appt_details">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" id="detail">
                    
                </div>
            </div>
        </div>
        <!-- /Appointment Details Modal -->
      
        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery.min.js') }}"></script>
        <script>
          $(() => {
            $('#show').click(e => {
              let that = e.currentTarget;
              e.preventDefault();
              $.ajax({
                method: $(that).attr('method'),
                url: $(that).attr('href'),
                data: $(that).serialize()
              })
              .done((data) => {
                $('#detail').html(data);
                $('#appt_details').modal('show');
              })
              .fail((data) => {
                console.log(data);
              });
            });
          });
        </script>
        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>
        
        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
        
    </body>
</html>