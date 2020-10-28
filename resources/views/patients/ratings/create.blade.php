<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AAH+ - Rate Doctor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <!-- Favicons -->
        <link type="image/x-icon" href="{{asset('assets/img/favicon.png') }}" rel="icon">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
        
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css') }}">

        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css') }}">

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css') }}">

        <link href="{{asset('css/star-rating.css') }}" media="all" rel="stylesheet" type="text/css" />
        
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
                                    <li class="breadcrumb-item active" aria-current="page">Rate Doctor</li>
                                </ol>
                            </nav>
                            <h2 class="breadcrumb-title">Rate Doctor</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->
            
            <!-- Page Content -->
            <div class="content">
                <div class="container">
                
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-body">
                                    <div class="booking-doc-info">
                                        <a href="{{route('doctor.profile', $doctor->id)}}" class="booking-doc-img">
                                            <img src="{{url('/storage/profile_images/'.$doctor->profile_picture ) }}" alt="User Image">
                                        </a>
                                        <div class="booking-info">
                                            <h4><a href="{{route('doctor.profile', $doctor->id)}}">Dr. {{$doctor->name}} {{$doctor->firstname}}</a></h4>
                                            <!--<div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">35</span>
                                            </div>-->
                                            @if($doctor->address != '')
                                            <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> {{$doctor->address}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('inc.messages')

                            <form method="POST" action="{{ route('ratings.store') }}" enctype="multipart/form-data">
                                {{csrf_field()}}

                            <div class="card booking-schedule schedule-widget">
                            
                                <div class="card-body">

                                    <h4 class="card-title">Rating : Dr. {{$doctor->name}} {{$doctor->firstname}}</h4>

                                    <div class="row form-row">

                                        <input type="hidden" name="doctor_id" id="doctor" class="form-control" value="{{$doctor->id}}">

                                        <input type="hidden" name="user_id" id="patient" class="form-control" value="{{auth()->user()->id}}">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                 <label>Rating <span class="text-danger">*</span></label>
                                                <input id="rating-system" type="number" class="rating" min="0" max="5" step="1" name="rating" value="{{ auth()->user()->userAverageRating($doctor->id) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Commentaire </label>
                                                <textarea class="form-control" rows="5" name="body" id=""></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- Submit Section -->
                            <div class="submit-section proceed-btn text-right">
                                <button type="submit" id="submit" class="btn btn-primary submit-btn">Save Changes</button>
                            </div>
                        </form>

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

        <script src="{{asset('js/star-rating.js') }}" type="text/javascript"></script>

        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

        <!-- Select2 JS -->
        <script src="{{asset('assets/plugins/select2/js/select2.min.js') }}"></script>
        
        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
      
    </body>
</html>

