@extends('admin.layouts.app')

@section('content')


<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">Administrators</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="javascript:(0);">Administrators</a></li>
				<li class="breadcrumb-item active">Add Admin</li>
			</ul>
		</div>
	</div>
</div>


<div class="col-md-12">
	@include('inc.messages')
	<div class="card">
		<div class="card-header">
			<div class="d-flex align-items-center">
				<h4 class="card-title">New Admin</h4>
			</div>
		</div>
		<div class="card-body">

			{{ Form::open(array('url' => 'users', 'enctype' => 'multipart/form-data')) }}
				<div class="row">

				<div class="col-md-6 pr-0">
					<div class="form-group">
                        {{ Form::label('name', 'Name') }}
                        {{ Form::text('name', '', array('class' => 'form-control form-control-uppercase')) }}
                      </div>
                  </div>

                  <div class="col-md-6 pr-0">
                      <div class="form-group">
                        {{ Form::label('firstname', 'Firstname') }}
                        {{ Form::text('firstname', '', array('class' => 'form-control form-control-capitalize', 'id' => 'firstname')) }}
                      </div>
                  </div>

                  <div class="col-md-6 pr-0">
                      <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', '', array('class' => 'form-control')) }}
                      </div>
                  </div>


                  <div class="col-md-6 pr-0">
                      <div class="form-group">
                        {{ Form::label('phone_number', 'Phone number') }}
                        {{ Form::text('phone_number', '', array('class' => 'form-control')) }}
                      </div>
                  </div>

                  <div class="col-md-6 pr-0">
                      <div class="form-group">
                            {{ Form::label('password', 'Password') }}<br>
                            {{ Form::password('password', array('class' => 'form-control')) }}
                      </div>
                  </div>

                  <div class="col-md-6 pr-0">
                      <div class="form-group">
                            {{ Form::label('password', 'Confirmation Password') }}<br>
                            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                      </div>
                    </div>

                    <div class="col-sm-6 pr-0">
                      <div class="form-group">
                        {{ Form::label('address', 'Address') }}
                        {{ Form::text('address', '' , array('class' => 'form-control', 'id' => 'address')) }}
                      </div>
                    </div>

                  
					<div class="col-md-6 pr-0">
                      <div class="form-group">
                          {{ Form::label('profile_picture', 'Profile Image') }}
                          {{ Form::file('profile_picture', array('class' => 'form-control')) }}
                      </div>
                  </div>
                    

					<div class="col-sm-12">
	                  	<h5><b>Assign Role</b></h5>
	                    <div class='form-group'>
	                        @foreach ($roles as $role)
	                            {{ Form::checkbox('roles[]',  $role->id ) }}
	                            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
	                        @endforeach
	                    </div>
					</div>

				</div>
			</div>

			<div class="card-footer">
				{{ Form::submit('Add Administrator', array('class' => 'btn btn-primary btn-block')) }}
			</div>
		{{ Form::close() }}

		</div>
	</div>

@endsection