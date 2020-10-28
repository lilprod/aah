@extends('admin.layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-7 col-auto">
            <h3 class="page-title">Prescriptions Types</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Prescriptions Types</li>
            </ul>
        </div>
        <div class="col-sm-5 col">
            <a href="{{ route('prescriptiontypes.create') }}" class="btn btn-primary float-right mt-2">Add</a>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        @include('inc.messages')
    </div>
</div>


 <div id="delete_drugtype" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-body text-center">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <p>Are you really to want to delete this Type of Prescription?</p>
                    
                </div>
                <div class="m-b-20 text-center"> 
                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
            </div>
        </form>
    </div>
</div>


 <div class="row">
    <div class="col-md-12">

        <div class="card">

            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">List of Prescriptions Types</h4>
                </div>
            </div>

             <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Prescriptions Types</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $k=1; ?>
                        	@foreach ($prescriptiontypes as $prescriptiontype)
                            <tr>
                                <td>N°{{$k}}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#">{{$prescriptiontype->title}}</a>
                                    </h2>
                                </td>
        						
                                <td class="text-right">

                                    <div class="actions">
                                        <a class="btn btn-sm bg-success-light" href="{{ URL::to('prescriptiontypes/'.$prescriptiontype->id.'/edit') }}">
                                            <i class="fe fe-pencil"></i> Edit
                                        </a>
                                        <a  data-toggle="modal" href="#" data-target="#delete_drugtype" onclick="deleteData({{ $prescriptiontype->id}})" class="btn btn-sm bg-danger-light">
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

   
@endsection

@push('prescriptiontype')
<script>
function deleteData(id)
     {
         var id = id;
         var url = '{{ route("prescriptiontypes.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endpush