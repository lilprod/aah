
@extends('admin.layouts.app')

@section('content')

<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">Administrateurs</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="javascript:(0);">Administrateurs</a></li>
				<li class="breadcrumb-item active">Liste des Admins</li>
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
                    <p>Etes-vous sûr(e) de vouloir supprimer cet administrateur?</p>
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
				<h4 class="card-title">List of Administrators</h4>
				<a href="{{ route('users.create') }}" class="btn btn-primary btn-round ml-auto" data-toggle="" data-target=""> <i class="fa fa-plus"></i>
					Add Admin</a>
			</div>
		</div>
	<div class="card-body">

		<div class="table-responsive">
			<table class="datatable table table-hover table-center mb-0">
				<thead>
				<tr>
					<th>Name et Firstname</th>
                    <th>Email</th>
                    <th>Date/Heure d'ajout</th>
                    <th>Role</th>
					<th style="width: 10%">Actions</th>
				</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Nom et Prénom(s)</th>
	                    <th>Email</th>
	                    <th>Date/Heure d'ajout</th>
	                    <th>Rôles</th>
						<th>Actions</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach ($users as $user)
					<tr>
						<td>{{ $user->name }} {{ $user->firstname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                        <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
						<td>
							<div class="form-button-action">
								<a href="{{ route('users.edit', $user->id) }}"><button type="button" data-toggle="tooltip" title="" class="btn btn-sm bg-success-light" data-original-title="Editer">
									<i class="fe fe-pencil"></i> Edit
								</button></a>
								<!--<a href="{{ route('users.edit', $user->id) }}" class="btn btn-link btn-primary btn-lg" style="margin-right: 3px;" data-original-title="Editer">
									<i class="fa fa-edit"></i>
								</a>-->

								<button type="button" data-toggle="modal" onclick="deleteData({{ $user->id}})" data-target="#confirm" title="" class="btn btn-sm bg-danger-light" data-original-title="Supprimer">
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

@push('user')
<script>
function deleteData(id)
 {
     var id = id;
     var url = '{{ route("users.destroy", ":id") }}';
     url = url.replace(':id', id);
     $("#deleteForm").attr('action', url);
 }

 function formSubmit()
 {
     $("#deleteForm").submit();
 }
</script>
@endpush