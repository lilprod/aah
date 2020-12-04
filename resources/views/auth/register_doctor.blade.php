<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Telemed AAH - Register</title>
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

        <link rel="stylesheet" href="{{asset('/assets/css/intlTelInput.css') }}">
        
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="assets/js/html5shiv.min.js"></script>
            <script src="assets/js/respond.min.js"></script>
        <![endif]-->
    
    </head>
    <body class="account-page">

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
                                    <li class="breadcrumb-item active" aria-current="page">Register</li>
                                </ol>
                            </nav>
                            <h2 class="breadcrumb-title">Register<span style="color: #26a9e166">+</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->
            
            <!-- Page Content -->
            <div class="content">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                                
                            <!-- Register Content -->
                            <div class="account-content">
                                <div class="row align-items-center justify-content-center">
                                    <!--<div class="col-md-12 col-lg-4 login-left">-->
                                    <div class="col-md-12 col-lg-5">
                                       <!-- <img src="{{asset('assets/img/login-banner.png') }}" class="img-fluid" alt="TelemedAAH Register">-->   
                                       <h2 class="card-title">IT'S TIME TO FIND YOU!</h2>
                                       <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                       <h3 class="card-title"><span style="color: #00A651; font-size: 50px; font-style: italic;">1</span> LET PATIENTS TO FIND YOU!</h3>
                                       <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                       <h3 class="card-title"><span style="color: #00A651; font-size: 50px; font-style: italic;">2</span> EASLY MANAGE BOOKINGS</h3>
                                       <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                       <h3 class="card-title"><span style="color: #00A651; font-size: 50px; font-style: italic;">3</span> INSTANTLY VIA MOBILE</h3>
                                       <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>

                                    </div>



                                    <div class="col-md-12 col-lg-7 login-right">
                                        <div class="login-header">
                                            <h3>{{ isset($url) ? ucwords($url) : ""}} Register<a href="{{route('register')}}"> Are you Patient?</a></h3>
                                        </div>
                                        
                                        <!-- Register Form -->

                                        @isset($url)
                                            <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                                        @else
                                            <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                                        @endisset
                                           
                                            @csrf

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control floating @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                <!--<label class="focus-label">Nom</label>-->

                                                 @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Firstname</label>
                                                <input type="text" class="form-control floating @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname">
                                                <!--<label class="focus-label">Prénom(s)</label>-->

                                                @error('firstname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                    <input type="email" class="form-control floating @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                    <!--<label class="focus-label">Email</label>-->

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">

                                                <div class="form-group">
                                                    <label>Phone number</label>
                                                    <input id="output" type="hidden" name="phone_number" value=""/>
                                                    <input type="tel" id="phone" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" required autocomplete="phone_number" placeholder="">

                                                    @error('phone_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control floating @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                    <!--<label class="focus-label">Mot de passe</label>-->

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Confirm password</label>
                                                    <input type="password" class="form-control floating" name="password_confirmation" required autocomplete="new-password">
                                                    <!--<label class="focus-label">Confirmation mot de passe</label>-->
                                                </div>
                                            </div>

                                             <!--<div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label>Gender</label>
                                                    <select class="form-control" id="gender" name="gender">
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                                    @error('gender')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label>Birth Date</label>
                                                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" name="birth_date" required autocomplete="birth_date" placeholder="Birth Date">

                                                    @error('birth_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label>Title</label>
                                                    <select class="form-control" id="title" name="title">
                                                        <option value="DR">Doctor</option>
                                                        <option value="PR">Professor</option>
                                                    </select>
                                                    @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label>Specialty</label>
                                                    <select class="form-control" id="speciality_id" name="speciality_id">
                                                        @foreach($specialities as $speciality)
                                                            <option value="{{$speciality->id}}">{{$speciality->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('specialty_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>-->

                                    

                                            <div class="col-sm-12">
                                                <div class="form-group mb-3">
                                                    <label>Organisation</label>
                                                    <input type="text" class="form-control @error('exercice_place') is-invalid @enderror" name="exercice_place" value="{{ old('exercice_place') }}" required autocomplete="exercice_place" placeholder="Organisation">

                                                    @error('exercice_place')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label>Region</label>
                                                    <select class="form-control" id="region" name="region" required>
                                                        <option value = "">--Select Region--</option>
                                                        <option value="1">WEST AFRICA</option>
                                                        <option value="2">EAST AFRICA</option>
                                                        <option value="3">NORTHEN AFRICA</option>
                                                        <option value="4">MIDDLE AFRICA</option>
                                                        <option value="5">SOUTHERN AFRICA</option>
                                                    </select>

                                                    <!--<label class="focus-label">Nom</label>-->

                                                    @error('region')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label>Country</label>
                                                    <select class="form-control @error('country') is-invalid @enderror" name="country" id="country">
                                                    </select>


                                                    @error('country')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            

                                           <!-- <div class="col-sm-6">
                                                <div class="form-group mb-3">
                                                    <label>Profile Image</label>
                                                    <input type="file" class="form-control" name="profile_picture">
                                                </div>
                                            </div>-->

                                    </div>
                                        
                                            

                                            <!--<div class="form-group form-focus">
                                                <input type="text" class="form-control floating @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                                                <label class="focus-label"> Adresse</label>

                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>-->

                                            


                                            <div class="text-right">
                                                <a class="forgot-link" href="{{ route('login') }}">Already have an account?</a>
                                            </div>
                                            <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Inscription</button>
                                            <!--<div class="login-or">
                                                <span class="or-line"></span>
                                                <span class="span-or">or</span>
                                            </div>
                                            <div class="row form-row social-login">
                                                <div class="col-6">
                                                    <a href="#" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f mr-1"></i> Login</a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="#" class="btn btn-google btn-block"><i class="fab fa-google mr-1"></i> Login</a>
                                                </div>
                                            </div>-->
                                        </form>
                                        <!-- /Register Form -->
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- /Register Content -->
                                
                                <!-- Download App-->
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                               <section class="section section-features">
                                    <div class="container-fluid">
                                       <div class="row">
                                            <div class="col-md-12">
                                                <div class="section-header">    
                                                   <!-- <h2 class="mt-2">DOWNLOAD <span style="color: #00A651;">AAH+</span> APP NOW!</h2>-->
                                                    <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.</p>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                </section>      
                            </div>
                        </div>
                    <!-- /Download App -->
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

         <script type="text/javascript" src="{{asset('assets/js/intlTelInput.js') }}"></script>
          <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
          <script>
          var input = document.querySelector("#phone");
          output = document.querySelector("#output");
          var iti = window.intlTelInput(input, {
            separateDialCode: true,
            /*nationalMode: true,
            initialCountry: "auto",
               geoIpLookup: function(callback) {
                $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                  var countryCode = (resp && resp.country) ? resp.country : "";
                  callback(countryCode);
                });
              },*/
            utilsScript: "{{asset('assets/js/utils.js?1537727621611') }}" // just for formatting/placeholders etc
          });

          var handleChange = function() {
            var text = iti.getNumber();
            var textNode = document.createTextNode(text);
            output.innerHTML = "";
            output.appendChild(textNode);
            document.getElementById("output").value=text;
          };

          // listen to "keyup", but also "change" to update when the user selects a country
          input.addEventListener('change', handleChange);
          input.addEventListener('keyup', handleChange);
          
            
          </script>
      
        
        <!-- jQuery -->
         <script src="{{asset('assets/js/jquery.min.js') }}"></script>

         <script type="text/javascript">
            $(document).ready(function() {

                 $('#region').on('change', function () {

                    var region_id = $(this).val();

                    if(region_id){
                        $.ajax({
                            url: '{!!URL::route('getCountries')!!}',
                            type: 'GET',
                            data : { 'id' : region_id},
                            dataType: 'json',

                            success:function(data){
                                //console.log('data');

                                if(data) {
                                    $('#country').empty();

                                    $('#country').focus;

                                    $('#country').append('<option value = "">--Select Country--</option>');

                                    $.each(data, function(key, value){
                                        $('select[name = "country"]').append('<option value= "'+ value.title +'">' + value.title + '</option>');
                                    });

                                    //$('select[name = "country"]').selectmenu('refresh', true);

                                    //$('select[name = "country"]').refresh();

                                    } else {
                                        $('#country').empty();
                                    } 
                                }
                                });
                            }
                            else{
                                $('#country').empty();
                            }
                        
                 });
            });
            </script>
        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
        
    </body>
</html>