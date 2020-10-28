@extends('admin.layouts.app')

@section('content')
	
		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title">Reviews</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
						<li class="breadcrumb-item active">Reviews</li>
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

		 <div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
		    <div class="modal-dialog modal-dialog-centered" role="document" >
		        <form action="" id="deleteForm" method="post">
		            <div class="modal-content">

		                <div class="modal-body">
		                	<div class="form-content p-2">
		                		<h4 class="modal-title">Delete</h4>
			                    {{ csrf_field() }}
			                    {{ method_field('DELETE') }}
			                    <p class="mb-4">Are you really to want to delete this Review?</p>
			                    
								<button type="submit" class="btn btn-primary">Save </button>
			                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			                    
		                	</div>
		                </div>

		            </div>
		        </form>
		    </div>
		</div>


		
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="datatable table table-hover table-center mb-0">
								<thead>
									<tr>
										<th>Patient Name</th>
										<th>Doctor Name</th>
										<th>Ratings</th>
										<th>Description</th>
										<th>Date</th>
										<th class="text-right">Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($reviews as $review)
									<tr>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="assets/img/patients/patient1.jpg" alt="User Image"></a>
												<a href="#">{{$review->patient_name}} {{$review->patient_firstname}}</a>
											</h2>
										</td>
										<td>
											<h2 class="table-avatar">
												<a href="#" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="assets/img/doctors/doctor-thumb-01.jpg" alt="User Image"></a>
												<a href="#">Dr. {{$review->doctor_name}} {{$review->doctor_firstname}}</a>
											</h2>
										</td>

										<td>
											<input id="rating-system" type="number" class="rating" min="0" max="5" step="1" name="rating" value="{{ $review->rating }}" disabled>
										</td>
										
										<td>
											-
										</td>
											<td>{{$review->created_at->format('d/m/Y')}} <br><small>{{$review->created_at->format('H:i')}}</small></td>
										<td class="text-right">
											<div class="actions">
												<a class="btn btn-sm bg-danger-light" data-toggle="modal" href="#delete_modal" onclick="deleteData({{ $review->id}})">
													<i class="fe fe-trash"></i> Delete
												</a>
												
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

@push('review')
<script>
function deleteData(id)
     {
         var id = id;
         var url = '{{ route("admin.reviewsDelete", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endpush