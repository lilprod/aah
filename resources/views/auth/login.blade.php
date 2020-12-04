<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AAH+ - Connexion</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        
        <!-- Favicons -->
        <link href="assets/img/favicon.png" rel="icon">
        
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
                                    <li class="breadcrumb-item active" aria-current="page">Connexion</li>
                                </ol>
                            </nav>
                            <h2 class="breadcrumb-title">Connexion<span style="color: #26a9e166">+</span></h2>
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
                            <div class="login-header text-center">
                                <h2 style="text-transform: uppercase;">Please login to <b>AAH+</b></h2>
                            </div>
                            <!-- Login Tab Content -->
                            <div class="account-content">
                                <div class="row align-items-center justify-content-center">
                                    <!-- <div class="col-md-7 col-lg-6 login-left">
                                       <img src="{{asset('assets/img/login-banner.png') }}" class="img-fluid" alt="Doccure Login"> 
                                        <div class="row form-row social-login">
                                                <div class="col-12">
                                                    <a href="#" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f mr-1"></i> Login</a>
                                                </div>
                                                <div class="col-12">
                                                    <a href="#" class="btn btn-google btn-block"><i class="fab fa-google mr-1"></i> Login</a>
                                                </div>
                                            </div> 
                                    </div>-->
                                    <div class="col-md-12 col-lg-10 login-right">

                                        <!--<div class="login-header">
                                            <h3>Connexion <span>Telemed AAH</span></h3>
                                        </div>-->
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <div class="row form-row social-login">

                                                <div class="col-12">
                                                    <br><br>
                                                    <a href="{{route('socialite.redirect', 'facebook')}}" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f mr-1"></i> Login</a>
                                                </div><br><br><br><br><br>
                                                <div class="col-12">
                                                    <a href="{{route('socialite.redirect', 'google')}}" class="btn btn-google btn-block"><i class="fab fa-google mr-1"></i> Login</a>
                                                    <br><br>
                                                </div>
                                                <!--<br><br>-->
                                                <!--<div class="col-12">
                                                    <a href="#" class="btn btn-instagram btn-block"><i class="fab fa-instagram mr-1"></i> Login</a>
                                                </div><br><br><br><br>-->
                                            </div> 

                                        </div>

                                        <div class="col-lg-6">

                                            @if(!$errors->has('email'))
                                                @include('inc.messages')
                                            @endif
                                        <form action="{{ route('login') }}" method="POST">
                                            @csrf

                                            <div class="form-group form-focus">
                                                <input type="text" class="form-control floating @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="text" autofocus>
                                                <label class="focus-label">Email</label>
                                                
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group form-focus">
                                                <input type="password" class="form-control floating @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                <label class="focus-label">Mot de passe</label>

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            @if (Route::has('password.request'))
                                                <div class="text-right">
                                                    <a class="forgot-link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                                                </div>
                                            @endif

                                            <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Connexion</button>
                                            <!--<div class="login-or">
                                                <span class="or-line"></span>
                                                <span class="span-or">or</span>
                                            </div>
                                            <div class="row form-row social-login">
                                                <div class="col-12">
                                                    <a href="#" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f mr-1"></i> Login</a>
                                                </div><br><br>

                                                <div class="col-12">
                                                    <a href="#" class="btn btn-google btn-block"><i class="fab fa-google mr-1"></i> Login</a>
                                                </div><br><br>

                                                <div class="col-12">
                                                    <a href="#" class="btn btn-instagram btn-block"><i class="fab fa-instagram mr-1"></i> Login</a>
                                                </div>


                                            </div>-->
                                           
                                        </form>

                                        </div>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                        <!-- /Login Tab Content -->
                        <br>
                        <div class="text-center dont-have">Vous n'avez-pas de compte? <a href="{{ route('register') }}">Inscription</a></div>
                    </div>




                        <!-- Download App-->
                        <div class="row justify-content-center">
                            <div class="col-md-7">
                               <section class="section section-features">
                                    <div class="container-fluid">
                                       <div class="row">
                                            <div class="col-md-5 features-img">
                                                <img src="{{asset('assets/img/apk.jpg') }}" class="img-fluid" alt="Feature">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="section-header">    
                                                    <h2 class="mt-2">DOWNLOAD <span style="color: #00A651;">AAH+</span> APP NOW!</h2>
                                                    <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                                </div>

                                                <div class="view-all left-right">
                                                    <a href="#" class="btn" style="padding: 0px 0px;"><img src="{{asset('assets/img/app.svg') }}" alt=""></a> 
                                                    <a href="#" class="btn" style="padding: 0px 0px;"><img src="{{asset('assets/img/play.svg') }}" alt=""></a>
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