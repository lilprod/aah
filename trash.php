
@extends('layouts.app')
<div class="chat-window">

                                <!-- Chat Left -->
                                <div class="chat-cont-left">
                                    <div class="chat-header">
                                        <span>Chats</span>
                                        <a href="javascript:void(0)" class="chat-compose">
                                            <i class="material-icons">control_point</i>
                                        </a>
                                    </div>
                                    <form class="chat-search">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-search"></i>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Search">
                                        </div>
                                    </form>
                                    
                                    @if($users->count() > 0)

                                    <div class="chat-users-list">
                                        
                                        <div class="chat-scroll">
                                            @foreach($users as $user)
                                            <a href="javascript:void(0);" class="media chat-toggle" data-id="{{ $user->id }}" data-user="{{ $user->name }}" title="Open Chat">
                                                <div class="media-img-wrap">
                                                    <div class="avatar avatar-away">
                                                        <img src="assets/img/doctors/doctor-thumb-01.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <div>
                                                        @if($user->role_id == 2)
                                                            <div class="user-name">Dr. {{$user->name}} {{$user->firstname}}</div>
                                                        @else
                                                            <div class="user-name">{{$user->name}} {{$user->firstname}}</div>
                                                        @endif
                                                        <!--<div class="user-last-chat">Hey, How are you?</div>-->
                                                    </div>
                                                    <div>
                                                        <!--<div class="last-chat-time block">2 min</div>
                                                        <div class="badge badge-success badge-pill">15</div>-->
                                                    </div>
                                                </div>
                                            </a>    
                                            @endforeach
                                    </div>

                                    <input type="hidden" id="current_user" value="{{ \Auth::user()->id }}" />
                                    <input type="hidden" id="pusher_app_key" value="{{ env('PUSHER_APP_KEY') }}" />
                                    <input type="hidden" id="pusher_cluster" value="{{ env('PUSHER_APP_CLUSTER') }}" />
                                    
                                </div>

                                @else
                                    <p>No users found! try to add a new user using another browser by going to <a href="{{ url('register') }}">Register page</a></p>
                                @endif
                            </div>
                                <!-- /Chat Left -->



                                <!-- Chat Right -->
                                <div class="chat-cont-right">
                                
                                    @include('chats.chat-box')

                                </div>
                                <!-- /Chat Right -->


                                </div>
                                
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    window.onload = function () {
        CKEDITOR.replace('ckeditor', {
            filebrowserBrowseUrl: filemanager.ckBrowseUrl,
        });
    }
</script>

<textarea id="ck"></textarea>



----------------------SERVICES---------------------------

<!-- Start feature Area -->
            <section class="feature-area section-gap">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="menu-content pb-60 col-lg-8">
                            <div class="title text-center">
                                <h1 class="mb-10">Features that make us unique</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
                            </div>
                        </div>
                    </div>                          
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="single-feature d-flex flex-row">
                                <div class="icon">
                                    <span class="lnr lnr-rocket"></span>
                                </div>
                                <div class="details">
                                    <h4>24/7 Emergency</h4>
                                    <p>
                                        inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="single-feature d-flex flex-row">
                                <div class="icon">
                                    <span class="lnr lnr-heart-pulse"></span>
                                </div>
                                <div class="details">
                                    <h4>Expert Consultation</h4>
                                    <p>
                                        inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="single-feature d-flex flex-row">
                                <div class="icon">
                                    <span class="lnr lnr-chart-bars"></span>
                                </div>
                                <div class="details">
                                    <h4>X-Ray Service</h4>
                                    <p>
                                        inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
                                    </p>
                                </div>
                            </div>
                        </div>                                              
                        <div class="col-lg-6 col-md-6">
                            <div class="single-feature d-flex flex-row">
                                <div class="icon">
                                    <span class="lnr lnr-paw"></span>
                                </div>
                                <div class="details">
                                    <h4>Dental Science</h4>
                                    <p>
                                        inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="single-feature d-flex flex-row">
                                <div class="icon">
                                    <span class="lnr lnr-bug"></span>
                                </div>
                                <div class="details">
                                    <h4>Intensive Care</h4>
                                    <p>
                                        inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="single-feature d-flex flex-row">
                                <div class="icon">
                                    <span class="lnr lnr-users"></span>
                                </div>
                                <div class="details">
                                    <h4>Family Planning</h4>
                                    <p>
                                        inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct women face higher conduct.
                                    </p>
                                </div>
                            </div>
                        </div>                          
                    </div>
                </div>  
            </section>
            <!-- End feature Area -->