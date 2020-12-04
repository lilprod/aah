@extends('admin.layouts.app')

@section('content')

	<!-- Page Header -->
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="page-title">Diseases</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
					<li class="breadcrumb-item"><a href="javascript:(0);">Diseases</a></li>
					<li class="breadcrumb-item active">List</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /Page Header -->

	<div class="row">
		<div class="col-sm-12">		
				<div class="row mb-5">
                    <div class="col">
                        <!--<ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Active Blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Pending Blog</a>
                            </li>
                        </ul>-->
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-primary btn-sm" href="{{route('admin_diseases_create')}}"><i class="fas fa-plus mr-1"></i> Add Disease</a>
                    </div>
                </div>
			
				<!-- Blog -->
				<div class="row blog-grid-row">
					@foreach ($diseases as $disease)
					<div class="col-md-6 col-xl-4 col-sm-12">
						<!-- Blog Post -->
						<div class="blog grid-blog">
							<div class="blog-image">
								<a href="#"><img class="img-fluid" src="{{url('/storage/diseases/'.$disease->cover_image ) }}" alt="Post Image"></a>
							</div>
							<div class="blog-content">
								<ul class="entry-meta meta-item">
									<li>
										<div class="post-author">
											<a href="#"><img src="{{url('/storage/profile_images/'.$disease->author_image ) }}" alt="Post Author"> <span>Dr. {{$disease->author}}</span></a>
										</div>
									</li>
									<li><i class="far fa-clock"></i> {{ $disease->created_at->format('m/d/Y') }}</li>
								</ul>
								<h3 class="blog-title"><a href="#">{{$disease->title}}</a></h3>
								<p class="mb-0">{!! \Illuminate\Support\Str::limit($disease->body, 50, '...') !!}</p>
							</div>
							<div class="row pt-3">
								<div class="col"><a href="{{ URL::to('admin/diseases/'.$disease->id.'/edit') }}" class="text-success"><i class="far fa-edit"></i> Edit</a></div>
																							
								<div class="col text-right"><a href="javascript:void(0);" class="text-danger" data-toggle="modal" data-target="#deleteNotConfirmModal"><i class="far fa-trash-alt"></i> Inactive</a></div>
							</div>
						</div>
					<!-- /Blog Post -->
					</div>
					@endforeach
				</div>
			
				<!-- Blog Pagination -->
				<!--<div class="row">
					<div class="col-md-12">
						<div class="blog-pagination">
							<nav>
								<ul class="pagination justify-content-center">
									<li class="page-item disabled">
										<a class="page-link" href="#" tabindex="-1"><i class="fas fa-angle-double-left"></i></a>
									</li>
									<li class="page-item">
										<a class="page-link" href="#">1</a>
									</li>
									<li class="page-item active">
										<a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
									</li>
									<li class="page-item">
										<a class="page-link" href="#">3</a>
									</li>
									<li class="page-item">
										<a class="page-link" href="#"><i class="fas fa-angle-double-right"></i></a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>-->
				<!-- /Blog Pagination -->
				<!-- /Blog -->
		</div>			
	</div>

	<div class="modal fade" id="deleteNotConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="acc_title">Inactive Service?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<p id="acc_msg">Service is Booked and Inprogress..</p>
					</div>
					<div class="modal-footer">
						
						<button type="button" class="btn btn-danger si_accept_cancel" data-dismiss="modal">OK</button>
					</div>
				</div>
			</div>
		</div>

@endsection

@push('listing_disease')

@endpush