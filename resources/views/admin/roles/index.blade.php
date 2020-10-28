@extends('admin.layouts.app')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">Roles</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="javascript:(0);">Roles</a></li>
				<li class="breadcrumb-item active">List of Roles</li>
			</ul>
		</div>
	</div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="confirm">
	<div class="modal-dialog" role="document">
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                  <div class="modal-header">
                  	<h5 class="modal-title">Confirmation de suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                        
                  </div>
                  <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <p>Etes-vous sûr(e) de vouloir supprimer ce rôle?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Non, Fermer</button>
                    <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Oui, Supprimer</button>
                 </div>
            </div>
        </form>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="row">
<div class="col-md-12">
	@include('inc.messages')
	<div class="card">
		<div class="card-header">
			<div class="d-flex align-items-center">
				<h4 class="card-title">List of roles</h4>
				<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
					<i class="fa fa-plus"></i>
					Add role
				</button>
			</div>
		</div>
	<div class="card-body">
	<!-- Modal -->

		<div class="table-responsive">
			<table class="datatable table table-hover table-center mb-0" >
				<thead>
				<tr>
					<th>Roles</th>
					<th>Permissions</th>
					<th style="width: 10%">Actions</th>
				</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Roles</th>
						<th>Permissions</th>
						<th>Actions</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach ($roles as $role)
					<tr>
						<td>{{ $role->name }}</td>
                        <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>{{-- Retrieve array of permissions associated to a role and convert to string --}}
                        <td>
							<div class="form-button-action">
								<a href="{{ route('roles.edit', $role->id) }}"><button type="button" data-toggle="tooltip" title="" class="btn btn-sm bg-success-light" data-original-title="Edit">
									<i class="fe fe-pencil"></i> Edit
								</button></a>

							<button type="button" data-toggle="modal" onclick="deleteData({{ $role->id}})" data-target="#confirm" title="" class="btn btn-sm bg-danger-light" data-original-title="Delete">
									<i class="fe fe-trash"></i> Delete
								</button>
							</div>
						</td>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>

@endsection

@push('role')
<script>
function deleteData(id)
     {
         var id = id;
         var url = '{{ route("roles.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endpush