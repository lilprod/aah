@extends('admin.layouts.app')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">Permissions</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="javascript:(0);">Permissions</a></li>
				<li class="breadcrumb-item active">Add Permission</li>
			</ul>
		</div>
	</div>
</div>



<div class="col-lg-4 col-lg-offset-4">
	@include('inc.messages')
	<div class="card">
		<div class="card-header">
			<div class="d-flex align-items-center">
				<h4 class="card-title">New Permission</h4>
			</div>
		</div>
		<div class="card-body">
		{{ Form::open(array('url' => 'permissions')) }}
				<div class="row">
					<div class="col-sm-12">
	                  	<div class="form-group">
	                        {{ Form::label('name', 'Name of permission') }}
	                        {{ Form::text('name', '', array('class' => 'form-control')) }}
                        </div><br>
                            @if(!$roles->isEmpty())
                                <h6>Assign role to permission</h6>

                                @foreach ($roles as $role) 
                                    {{ Form::checkbox('roles[]',  $role->id ) }}
                                    {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                                @endforeach
                            @endif
					</div>

				</div>

			</div>
			<div class="card-footer">
				{{ Form::submit('Add Permission', array('class' => 'btn btn-primary btn-block')) }}
			</div>
		{{ Form::close() }}

		</div>
	</div>

@endsection