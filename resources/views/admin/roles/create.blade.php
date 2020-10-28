@extends('admin.layouts.app')

@section('content')
<div class="page-header">
  <div class="row">
    <div class="col-sm-12">
      <h3 class="page-title">Roles</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:(0);">Roles</a></li>
        <li class="breadcrumb-item active">Add Admin</li>
      </ul>
    </div>
  </div>
</div>

		<div class='col-lg-4 col-lg-offset-4'>
            <div class="card">
                <div class="card-header with-border">
                  <h3 class="card-title"><i class='fa fa-key'></i> Add role</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {{ Form::open(array('url' => 'roles')) }}
                  <div class="card-body">
                    <div class="form-group">
                        {{ Form::label('name', 'Name of role') }}
                        {{ Form::text('name', null, array('class' => 'form-control')) }}
                    </div>

                    <h5><b>Assign a/the permission(s) to role</b></h5>

                    <div class='form-group'>
                        @foreach ($permissions as $permission)
                            {{ Form::checkbox('permissions[]',  $permission->id ) }}
                            {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

                        @endforeach
                    </div>
                  </div>
                  <!-- /.box-body -->

              <div class="card-footer">
                {{ Form::submit('Add Role', array('class' => 'btn btn-primary btn-block')) }}
              </div>
            {{ Form::close() }}
          </div>
	</div>

@endsection