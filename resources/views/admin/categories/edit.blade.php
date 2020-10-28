@extends('admin.layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="row">
        <div class="col-sm-7 col-auto">
            <h3 class="page-title">Categories</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Edit Category {{$category->title}}</li>
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
        <form method="POST" action="{{ route('categories.update', $category->id) }}" enctype="multipart/form-data">
        	{{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="row form-row">
                <div class="col-12 col-sm-12">
        			<div class="form-group">
        				<label>Category </label>
        				<input class="form-control" type="text" name="title" value="{{$category->title}}" id="title">
        			</div>
                </div>

                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label for="slug">Slug*</label>
                        <input type="text" id="slug" name="slug" class="form-control" value="{{$category->slug}}">
                    </div>
                </div>
            
                <div class="col-12 col-sm-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea cols="30" rows="4" class="form-control" name="description">{{$category->description}}</textarea>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary btn-block">Save Changes</button>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
  $('#title').change(function(e) {
    $.get('{{ route('category.check_slug') }}', 
      { 'title': $(this).val() }, 
      function( data ) {
        $('#slug').val(data.slug);
      }
    );
  });
</script>
@endpush