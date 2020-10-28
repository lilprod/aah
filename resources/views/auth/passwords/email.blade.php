<!DOCTYPE html> 
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>Telemed AAH - Forgot Password</title>
        
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
    <body class="account-page">

        <!-- Main Wrapper -->
        <div class="main-wrapper">

        @include('website.hearder')

        <!-- Page Content -->
            <div class="content">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            
                            <!-- Account Content -->
                            <div class="account-content">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-md-7 col-lg-6 login-left">
                                        <img src="{{asset('assets/img/login-banner.png') }}" class="img-fluid" alt="Login Banner">    
                                    </div>
                                    <div class="col-md-12 col-lg-6 login-right">
                                        <div class="login-header">
                                            <h3>Forgot Password?</h3>
                                            <p class="small text-muted">Enter your email to get a password reset link</p>
                                        </div>

                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        
                                        <!-- Forgot Password Form -->
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="form-group form-focus">
                                                <input id="email" type="email" class="form-control floating @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                <label class="focus-label">Email</label>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="text-right">
                                                <a class="forgot-link" href="{{route('login')}}">Remember your password?</a>
                                            </div>

                                            <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">{{ __('Send Password Reset Link') }}</button>
                                            
                                        </form>
                                        <!-- /Forgot Password Form -->
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- /Account Content -->
                            
                        </div>
                    </div>

                </div>

            </div>      
            <!-- /Page Content -->

            @include('website.footer')

        </div>
       <!-- /Main Wrapper -->
      
        <!-- jQuery -->
        <script src="{{asset('assets/js/jquery.min.js') }}"></script>
        
        <!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js') }}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Slick JS -->
        <script src="{{asset('assets/js/slick.js') }}"></script>
        
        <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>
        
    </body>
</html>