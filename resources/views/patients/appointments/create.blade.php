<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AAH+ - Booking</title>
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

        <!-- Daterangepikcer CSS -->
        <link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
        
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
                                    <li class="breadcrumb-item active" aria-current="page">Booking</li>
                                </ol>
                            </nav>
                            <h2 class="breadcrumb-title">Booking <span style="color: #26a9e166">+</span></h2>
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
                            @include('inc.messages')
                            <div class="card">
                                <div class="card-body">
                                    <div class="booking-doc-info">
                                        <a href="{{route('doctor.profile', $doctor->id)}}" class="booking-doc-img">
                                            <img src="{{url('/storage/profile_images/'.$doctor->profile_picture ) }}" alt="User Image">
                                        </a>
                                        <div class="booking-info">
                                            <h4><a href="{{route('doctor.profile', $doctor->id)}}">Dr. {{$doctor->name}} {{$doctor->firstname}}</a></h4>
                                            <div class="rating">
                                                <!--<i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">35</span>-->
                                                <input id="rating-system" type="number" class="rating" min="0" max="5" step="1" name="rating" value="{{ $doctor->averageRating }}" disabled>
                                            </div>
                                            @if($doctor->address != '')
                                            <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> {{$doctor->address}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <form method="POST" action="{{ route('appointments.store') }}" enctype="multipart/form-data">
                            {{csrf_field()}}

                            <div class="card booking-schedule schedule-widget">
                            
                                <div class="card-body">
                                    <h4 class="card-title">Booking : Dr. {{$doctor->name}} {{$doctor->firstname}}</h4>
                                    <div class="row form-row">

                                        <input type="hidden" name="doctor_id" id="doctor" class="form-control" value="{{$doctor->id}}">

                                        <input type="hidden" name="user_id" id="patient" class="form-control" value="{{auth()->user()->id}}">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                 <label>Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="date_apt" id="date" onchange="setCorrect(this,'date');" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Schedule</label>
                                                <select class="form-control select" name="schedule_id" id="schedule">
                                                        <option value=""></option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label>Note </label>
                                                <textarea class="form-control" rows="5" name="note" id="article-ckeditor"></textarea>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Payment Mode</label>
                                                <select class="form-control select" name="payment_mode">
                                                        <option value="1">Flooz</option>
                                                        <option value="2">T-Money</option>
                                                        <option value="3">Paypal</option>
                                                        <option value="4">Stripe</option>
                                                </select>
                                            </div>
                                        </div>

                                        <p id="not-available" style="display: none; color: red; text-align: center;">
                                            <i class="fa fa-exclamation-circle"></i> Votre médécin est indisponible. Veuillez choisir une autre date ou période
                                        </p>

                                        <p id="available" style="display: none; color: green; text-align: center">
                                            <i class="fa fa-check-circle"></i> Le médécin est disponible à cette période
                                        </p>

                                    </div>


                                    
                                </div>
                            </div>

                            <!-- Submit Section -->
                            <div class="submit-section proceed-btn text-right">
                                <!--<button type="submit" id="submit" class="btn btn-primary submit-btn" disabled>Save Changes</button>-->
                                <button type="submit" id="submit" class="btn btn-primary submit-btn" disabled>Proceed to Pay</button>
                                <!--<a href="checkout.html" class="btn btn-primary submit-btn">Proceed to Pay</a>-->
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

        <script src="{{ asset('ckeditor/ckeditor.js')}}"></script> 

        <script> CKEDITOR.replace('article-ckeditor'); </script>
        
        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Sticky Sidebar JS -->
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
        <script src="{{asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

        <!-- Select2 JS -->
        <script src="{{asset('assets/plugins/select2/js/select2.min.js') }}"></script>

        <!-- Daterangepikcer JS -->
        <script src="{{asset('assets/js/moment.min.js') }}"></script>
        <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
        
        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
      
        <script type="text/javascript">
        $(document).ready(function() {

             $('#date').on('change', function () {

                var apt_date = $(this).val();

                 var doctor = $('#doctor').val();

                if(apt_date){
                    $.ajax({
                        url: '{!!URL::route('getSchedules')!!}',
                        type: 'GET',
                        data : { 'date' : apt_date, 'doctor' : doctor},
                        dataType: 'json',

                        success:function(data){
                            //console.log(data);

                            if(data != '') {
                                $('#schedule').empty();

                                $('#schedule').focus;

                                $('#schedule').append('<option value = "">--Select Schedule Time--</option>');

                                $.each(data, function(key, value){
                                $('select[name = "schedule_id"]').append('<option value= "'+ value.id +'">' + value.begin_time + '-'+ value.end_time + '</option>');
                                });
                                //$('select[name = "schedule_id"]').refresh();

                                document.getElementById('submit').disabled = '';
                                $('#available').show();
                                $('#not-available').hide();

                                } /*else if(data === ''){
                                    $('#schedule').empty();

                                    $('#schedule').focus;

                                    $('#schedule').append('<option value = "">No Schedule Time Found!</option>');
                                }*/

                                else {
                                    $('#schedule').empty();

                                    document.getElementById('submit').disabled = 'disabled';
                                    $('#not-available').show();
                                    $('#available').hide()
                                } 
                            }
                            });
                        }
                        else{
                            $('#schedule').empty();
                        }
                    
             });

             
        });
        </script>

        <script language="javascript">
        //function to convert enterd date to any format
        function setCorrect(xObj,xTarget){
        var today = new Date();  
            var date = new Date(xObj.value);
            var month = date.getMonth() + 1;
            var day = date.getDate();
            var year = date.getFullYear();
            var monthd = today.getMonth() + 1;
            var dayd = today.getDate();
            var yeard = today.getFullYear();
            console.log(day+' '+ month +' '+year+'\n');
            console.log(dayd+' '+ monthd +' '+yeard);

            if(year<yeard){
                    //console.log("modif1");
                    if (dayd<10) {
                        document.getElementById(xTarget).value=yeard+"-"+monthd+"-0"+dayd;
                    }else {
                        document.getElementById(xTarget).value=yeard+"-"+monthd+"-"+dayd;
                    }
            }else if(year=yeard) {
                if(month<monthd){
                //console.log("modif2");
                if (dayd<10) {
                    document.getElementById(xTarget).value=yeard+"-"+monthd+"-0"+dayd;
                }else {
                    document.getElementById(xTarget).value=yeard+"-"+monthd+"-"+dayd;
                }
                }else if(month==monthd) {
                    if(day<dayd){
                        //console.log("modif3");
                        if (dayd<10) {
                            document.getElementById(xTarget).value=yeard+"-"+monthd+"-0"+dayd;
                        }else {
                            document.getElementById(xTarget).value=yeard+"-"+monthd+"-"+dayd;
                        }
                    }
                }
            }
            /*if(day<dayd && month<monthd && year<yeard){

                    console.log("success");
            }else {
                console.log("fucked");
            }

            $('#time').on('change', function () {
                var department = $('#department').val();
                var doctor = $('#doctor').val();
                var date = $('#date').val();
                var time = $('#time').val();
                 if(time){
                   $.ajax({
                    url: '{!!URL::route('checkUp')!!}',
                    type: 'POST',
                    dataType: 'json',
                    data : {
                        _token : "{{ csrf_token() }}",
                        department : department,
                        doctor : doctor,
                        date : date,
                        time : time,
                    },

                    success:function(data){
                            //console.log(data);
                            console.log(data);
                            if(data == 1){
                               document.getElementById('submit').disabled = 'disabled';
                               $('#not-available').show()
                               $('#available').hide()
                            }else{
                               document.getElementById('submit').disabled = '';
                               $('#available').show()
                               $('#not-available').hide()
                            }
                            
                        }
                    }); 
                 }
                 
             });

            */
        }
         </script>
    </body>
</html>

