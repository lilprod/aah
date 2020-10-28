@extends('admin.layouts.app')

@section('content')
<div class="page-header">
	<h4 class="page-title">Permissions</h4>
		<ul class="breadcrumbs">
			<li class="nav-home">
				<a href="#">
					<i class="flaticon-home"></i>
				</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Permissions</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Editer une permission</a>
			</li>
		</ul>
</div>


<div class="col-lg-4 col-lg-offset-4">
	@include('inc.messages')
	<div class="card">
		<div class="card-header">
			<div class="d-flex align-items-center">
				<h4 class="card-title">Editer {{$permission->name}}</h4>
			</div>
		</div>
		{{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with permission data --}}

            <div class="card-body">

                <div class="form-group">
                    {{ Form::label('name', 'Nom de la permission') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>

           </div>

           <div class="card-footer">
                {{ Form::submit('Editer', array('class' => 'btn btn-primary btn-block')) }}
            </div>
            {{ Form::close() }}

		</div>
	</div>

@endsection