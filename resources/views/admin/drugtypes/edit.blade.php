@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-7 col-auto">
            <h3 class="page-title">Drugs Types</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Drug Type {{$drugtype->title}}</li>
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
        <form method="POST" action="{{ route('drugtypes.update', $drugtype->id) }}" enctype="multipart/form-data">
        	{{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="row form-row">
                <div class="col-12 col-sm-12">
        			<div class="form-group">
        				<label>Drug Type </label>
        				<input class="form-control" type="text" name="title" value="{{$drugtype->title}}" id="title">
        			</div>
                </div>

            
                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea cols="30" rows="4" class="form-control" name="description">{{$drugtype->description}}</textarea>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>

        </form>
    </div>
</div>

@endsection