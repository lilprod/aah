<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AAH+ - 2FA Settings</title>
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
                                    <li class="breadcrumb-item active" aria-current="page">2FA Settings</li>
                                </ol>
                            </nav>
                            <h2 class="breadcrumb-title">2FA Settings<span style="color: #26a9e166">+</span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

            <!-- Page Content -->
            <div class="content">
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col-md-8 offset-md-4">
                            
                            <!-- Login Tab Content -->
                            <div class="account-content">
                                    <div class="col-lg-6">
                                        <div class="login-header">
                                            <h3>Two Factor <span>Settings</span></h3>
                                        </div>
                                         <p>Two factor authentication (2FA) strengthens access security by requiring two methods (also referred to as factors) to verify your identity. Two factor authentication protects against phishing, social engineering and password brute force attacks and secures your logins from attackers exploiting weak or stolen credentials.</p>

                                        @include('inc.messages')
                                       
                                        @if($user->google2fa_enable == 0)
                                        1. Scan this QR code with your Google Authenticator App. Alternatively, you can use the code: <code>{{ $secret }}</code><br/>
                                        <img src="{{ $QR_Image }}" alt="">
                                        <br/><br/>
                                        2. Enter the pin from Google Authenticator app:<br/><br/>
                                        <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                                            {{ csrf_field() }}
                                            <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }}">
                                                <label for="secret" class="control-label">Authenticator Code</label>
                                                <input id="secret" type="password" class="form-control col-md-4" name="secret" required>
                                                @if ($errors->has('verify-code'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('verify-code') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                Enable 2FA
                                            </button>
                                        </form>
                                        @elseif($user->google2fa_enable == 1)
                                            <div class="alert alert-success">
                                                2FA is currently <strong>enabled</strong> on your account.
                                            </div>
                                            <p>If you are looking to disable Two Factor Authentication. Please confirm your password and Click Disable 2FA Button.</p>
                                            <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                                                {{ csrf_field() }}
                                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                                    <label for="change-password" class="control-label">Current Password</label>
                                                        <input id="current-password" type="password" class="form-control col-md-4" name="current-password" required>
                                                        @if ($errors->has('current-password'))
                                                            <span class="help-block">
                                                        <strong>{{ $errors->first('current-password') }}</strong>
                                                        </span>
                                                        @endif
                                                </div>
                                                <button type="submit" class="btn btn-primary ">Disable 2FA</button>
                                            </form>
                                        @endif
                                  </div>
                        </div>
                            <!-- /Login Tab Content -->
                                
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