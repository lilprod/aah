@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="page-title">List of Patients</h3>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{('admin.dashboard')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="javascript:(0);">Patients</a></li>
				<li class="breadcrumb-item active">List</li>
			</ul>
		</div>
	</div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        @include('inc.messages')
    </div>
</div>

<div class="row">
	<div class="col-md-12">

	<div class="card">
		<div class="card-body">
		<div class="table-responsive">
			<table class="datatable table table-hover table-center mb-0">
				<thead>
					<tr>
						<th>Patient ID</th>
						<th>Patient Name</th>
						<th>Age</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Last Visit</th>
						<!--<th class="text-right">Paid</th>-->
						<th class="text-right">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $k=1; ?>
					@foreach ($patients as $patient)
					<tr>
						<td>#PT00{{$k}}</td>
						<td>
							<h2 class="table-avatar">
								<a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="assets/img/patients/patient2.jpg" alt="User Image"></a>
								<a href="#">{{$patient->name}} {{$patient->firstname}} </a>
							</h2>
						</td>
						<td>{{$patient->age}}</td>
						<td>{{$patient->address}}</td>
						<td>{{$patient->phone_number}}</td>
						<td>-</td>
						<!--<td class="text-right">$200.00</td>-->
						<td class="text-right">

                            <div class="actions">
                            	<a class="btn btn-sm bg-success-light" href="{{ route('patients.show', $patient->id) }}">
                                    <i class="fe fe-eye"></i> Show
                                </a>

                                <a class="btn btn-sm bg-success-light" href="{{ URL::to('patients/'.$patient->id.'/edit') }}">
                                    <i class="fe fe-pencil"></i> Edit
                                </a>
                              <a data-toggle="modal" href="#" data-target="#delete_patient" onclick="deleteData({{ $patient->id}})" class="btn btn-sm bg-danger-light">
                                    <i class="fe fe-trash"></i> Delete
                                </a>
                            </div>
                        </td>
					</tr>
					<?php $k+= 1; ?>
					@endforeach
				</tbody>
			</table>
		</div>

		</div>
		</div>
	</div>
</div>

<div id="delete_patient" class="modal fade delete-modal" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<form action="" id="deleteForm" method="post">
			<div class="modal-content">
				<div class="modal-body text-center">
					{{ csrf_field() }}
	                {{ method_field('DELETE') }}
					<img src="/assets/assets/img/sent.png" alt="" width="50" height="46">
					<h3>Etes-vous sûr(e) de vouloir supprimer ce Patient?</h3>
				</div>
				<div class="m-b-20 text-center"> 
					<a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
					<button type="submit" class="btn btn-danger">Delete</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection

@push('patient')
<script>
function deleteData(id)
     {
         var id = id;
         var url = '{{ route("patients.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endpush