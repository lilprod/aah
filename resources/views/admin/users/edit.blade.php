@extends('admin.layouts.app')
@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">Administrators</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="javascript:(0);">Administrators</a></li>
				<li class="breadcrumb-item active">Edit Admin</li>
			</ul>
		</div>
	</div>
</div>


<div class="col-md-12">
	@include('inc.messages')
	<div class="card">
		<div class="card-header">
			<div class="d-flex align-items-center">
				<h4 class="card-title">Nouvel utilisateur</h4>
			</div>
		</div>
		<div class="card-body">
			{{ Form::model($user, array('route' => array('users.update', $user->id) , 'method' => 'PUT', 'enctype' => 'multipart/form-data')) }}{{-- Form model binding to automatically populate our fields with user data --}}
			<div class="row">

				<div class="col-md-6 pr-0">
					<div class="form-group">
                        {{ Form::label('name', 'Nom') }}
                        {{ Form::text('name', null, array('class' => 'form-control form-control-uppercase')) }}
                      </div>
                  </div>

                  <div class="col-md-6 pr-0">
                      <div class="form-group">
                        {{ Form::label('firstname', 'Prénoms') }}
                        {{ Form::text('firstname', null, array('class' => 'form-control form-control-capitalize', 'id' => 'firstname')) }}
                      </div>
                  </div>

                  <div class="col-md-6 pr-0">
                      <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', null, array('class' => 'form-control')) }}
                      </div>
                  </div>


                  <div class="col-md-6 pr-0">
                      <div class="form-group">
                        {{ Form::label('phone_number', 'Numero de téléphone') }}
                        {{ Form::text('phone_number', null, array('class' => 'form-control')) }}
                      </div>
                  </div>

                  <div class="col-sm-12">
                      <div class="form-group">
                        {{ Form::label('address', 'Adresse') }}
                        {{ Form::textarea('address', null , array('class' => 'form-control', 'id' => 'address')) }}
                      </div>
                    </div>

                  <div class="col-md-6 pr-0">
                      <div class="form-group">
                            {{ Form::label('password', 'Mot de passe') }}<br>
                            {{ Form::password('password', array('class' => 'form-control')) }}
                      </div>
                  </div>

                  <div class="col-md-6 pr-0">
                      <div class="form-group">
                            {{ Form::label('password', 'Confirmation du mot de passe') }}<br>
                            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                      </div>
                    </div>

                  
					<div class="col-md-6 pr-0">
                      <div class="form-group">
                          {{ Form::label('profile_picture', 'Image de profil') }}
                          {{ Form::file('profile_picture', array('class' => 'form-control')) }}
                      </div>
                  </div>
                    

					<div class="col-sm-12">
	                  	<h5><b>Assigner Rôle</b></h5>
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
				{{ Form::submit('Ajouter', array('class' => 'btn btn-primary')) }}
			</div>
		{{ Form::close() }}

		</div>
	</div>

@endsection