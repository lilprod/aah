@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-7 col-auto">
            <h3 class="page-title">Drugs</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Drug {{$drug->name}}</li>
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
    <div class="col-lg-6 offset-lg-3">
        <form method="POST" action="{{ route('drugs.update', $drug->id) }}" enctype="multipart/form-data">
        	{{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="row form-row">
                <div class="col-12 col-sm-12">
        			<div class="form-group">
        				<label>Drug Name </label>
        				<input class="form-control" type="text" name="name" value="{{$drug->title}}" id="name">
        			</div>
                </div>

                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label for="generic_name">Generic Name</label>
                        <input type="text" id="generic_name" name="generic_name" class="form-control" value="{{$drug->generic_name}}">
                    </div>
                </div>

                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label>Drug Type</label>
                        <select class="form-control select" name="drug_type_id">
                            @foreach($drugtypes as $drugtype)
                                <option value="{{$drugtype->id}}"  {{ ($drug->drug_type_id === $drugtype->id) ? 'selected' : '' }}">{{$drugtype->title}}</option>.
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label>Short Note</label>
                        <textarea cols="30" rows="4" class="form-control" name="short_note">{{$drug->short_note}}</textarea>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>

        </form>
    </div>
</div>

@endsection