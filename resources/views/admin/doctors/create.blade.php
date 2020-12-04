@extends('admin.layouts.app')

@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Doctors</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:(0);">Doctors</a></li>
                <li class="breadcrumb-item active">New Doctor</li>
            </ul>
        </div>
    </div>
</div>


<div class="col-md-12">
    @include('inc.messages')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">New Doctor</h4>
            </div>
        </div>
        <form method="POST" action="{{ route('doctors.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                	
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Firstname <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="firstname">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Phone number <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="phone_number">
                            </div>
                        </div>


        				<div class="col-sm-6">
                            <div class="form-group">
                                <label>Birth Date  <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="birth_date">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Speciality <span class="text-danger">*</span></label>
                                <select class="select" name="speciality_id">
                                    @foreach($specialities as $speciality)
                                    <option value="{{ $speciality->id }}">{{ $speciality->title }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Profession <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="profession">
                            </div>
                        </div>


                        <div class="col-sm-6">
        					<div class="form-group gender-select">
        						<label class="gen-label">Gender: <span class="text-danger">*</span></label>
        						<div class="form-check-inline">
        							<label class="form-check-label">
        								<input type="radio" name="gender" value="M" class="form-check-input">Masculin
        							</label>
        						</div>
        						<div class="form-check-inline">
        							<label class="form-check-label">
        								<input type="radio" name="gender" value="F" class="form-check-input">Feminin
        							</label>
        						</div>
        					</div>
                        </div>

        				<div class="col-sm-6">
        					<div class="form-group">
        						<label>Address <span class="text-danger">*</span></label>
        						<input type="text" class="form-control " name="address">
        					</div>
        				</div>

                        <div class="col-sm-6">
        					<div class="form-group">
        						<label>Avatar</label>
        						<div class="profile-upload">
        							<div class="upload-img">
        								<img alt="" src="/assets/assets/img/user.jpg">
        							</div>
        							<div class="upload-input">
        								<input type="file" class="form-control" name="profile_picture">
        							</div>
        						</div>
        					</div>
                        </div>
                        
                    </div>

        			<div class="form-group">
                        <label>Short Biography</label>
                        <textarea class="form-control" rows="3" cols="30" name="biography"></textarea>
                    </div>

                    <div class="form-group">
                        <label class="display-block">Status</label>
        				<div class="form-check form-check-inline">
        					<input class="form-check-input" type="radio" name="status" id="doctor_active" value="1" checked>
        					<label class="form-check-label" for="doctor_active">
        					Actif
        					</label>
        				</div>
        				<div class="form-check form-check-inline">
        					<input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="0">
        					<label class="form-check-label" for="doctor_inactive">
        					Inactif
        					</label>
        				</div>
                    </div>

                </div>

                    <div class="card-footer">
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn">Add Docteur</button>
                        </div>
                    </div>
                </form>
    </div>
</div>

@endsection