@extends('admin.layouts.app')

@section('content')

<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-7 col-auto">
            <h3 class="page-title">Services</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Services</li>
            </ul>
        </div>
        <div class="col-sm-5 col">
            <a href="{{ route('services.create') }}" class="btn btn-primary float-right mt-2">Add</a>
        </div>
    </div>
</div>
<!-- /Page Header -->

<div class="row">
    <div class="col-md-12">
        @include('inc.messages')
    </div>
</div>


 <div id="delete_service" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-body text-center">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <img src="{{asset('/assets/assets/img/sent.png')}}" alt="" width="50" height="46">
                    <p>Are you really to want to delete this Service?</p>
                    
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
                    <h4 class="card-title">List of Services</h4>
                </div>
            </div>

             <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0 datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Services</th>
                                <th>Specialities</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $k=1; ?>
                        	@foreach ($services as $service)
                            <tr>
                                <td>#SERV00{{$k}}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#">{{$service->title}}</a>
                                    </h2>
                                </td>

                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#">{{$service->speciality->title}}</a>
                                    </h2>
                                </td>
        						
                                <td class="text-right">

                                    <div class="actions">
                                        <a class="btn btn-sm bg-success-light" href="{{ URL::to('services/'.$service->id.'/edit') }}">
                                            <i class="fe fe-pencil"></i> Edit
                                        </a>
                                        <a  data-toggle="modal" href="#" data-target="#delete_service" onclick="deleteData({{ $service->id}})" class="btn btn-sm bg-danger-light">
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

@push('service')
<script>
function deleteData(id)
     {
         var id = id;
         var url = '{{ route("services.destroy", ":id") }}';
         url = url.replace(':id', id);
         $("#deleteForm").attr('action', url);
     }

     function formSubmit()
     {
         $("#deleteForm").submit();
     }
</script>
@endpush