@extends('admin.layouts.app')

@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">Roles</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="javascript:(0);">Roles</a></li>
				<li class="breadcrumb-item active">Edit Role</li>
			</ul>
		</div>
	</div>
</div>

<div class="col-lg-4 col-lg-offset-4">
	@include('inc.messages')
	<div class="card">
		<div class="card-header with-border">
              <h3 class="card-title"><i class='fa fa-key'></i> Editer rôle: {{$role->name}}</h3>
            </div>
      
            {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', 'Nom du Role') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>

                <h5><b>Assign Permissions</b></h5>
                @foreach ($permissions as $permission)

                    {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
                    {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

                @endforeach
                <br>
            </div>

            <div class="card-footer">
                {{ Form::submit('Editer', array('class' => 'btn btn-primary btn-block')) }}
            </div>
            {{ Form::close() }}  

		</div>
	</div>

@endsection