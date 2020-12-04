@extends('admin.layouts.app')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="page-title">Patients</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="javascript:(0);">Patients</a></li>
                <li class="breadcrumb-item active">Edit Patient</li>
            </ul>
        </div>
    </div>
</div>


<div class="col-md-12">
    @include('inc.messages')
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Edit Patient {{$patient->name}}</h4>
            </div>
        </div>
        <form method="POST" action="{{ route('patients.update', $patient->id) }}" enctype="multipart/form-data">
        	{{ csrf_field() }}
            {{ method_field('PATCH') }}

        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name" value="{{$patient->name}}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Firstname <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="firstname" value="{{$patient->firstname}}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input class="form-control" type="email" name="email" value="{{$patient->email}}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phone number <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="phone_number" value="{{$patient->phone_number}}">
                    </div>
                </div>

				<div class="col-sm-6">
                    <div class="form-group">
                        <label>Birth Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="birth_date" value="{{$patient->birth_date}}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Birth Place<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="place_birth" value="{{$patient->place_birth}}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Profession <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="profession" value="{{$patient->profession}}">
                    </div>
                </div>

                <div class="col-sm-6">
					<div class="form-group gender-select">
						<label class="gen-label">Gender: <span class="text-danger">*</span></label>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input type="radio" name="gender" value="M" class="form-check-input" {{  $patient->gender == "M" ? 'checked' : '' }} >Masculin
							</label>
						</div>
						<div class="form-check-inline">
							<label class="form-check-label">
								<input type="radio" name="gender" value="F" class="form-check-input" {{  $patient->gender == "F" ? 'checked' : '' }} >Feminin
							</label>
						</div>
					</div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Marital Status <span class="text-danger">*</span></label>
                        <select class="select" name="marital_status" required="">
                            <option value="Célibataire" {{ ($patient->marital_status === 'Célibataire') ? 'selected' : '' }}>Célibataire</option>
                            <option value="Marié(e)" {{ ($patient->marital_status === 'Marié(e)') ? 'selected' : '' }}>Marié(e)</option>
                            <option value="Veuf(ve)" {{ ($patient->marital_status === 'Veuf(ve)') ? 'selected' : '' }}>Veuf(ve)</option>
                            <option value="Divorcé(e)" {{ ($patient->marital_status === 'Divorcé(e)') ? 'selected' : '' }}>Divorcé(e)</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nationality <span class="text-danger">*</span></label>
                        <input type="text" class="form-control " value="{{$patient->nationality}}" name="nationality">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ethnic Group <span class="text-danger">*</span></label>
                        <input type="text" class="form-control " name="ethnic_group" value="{{$patient->ethnic_group}}">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Blood Group <span class="text-danger">*</span></label>
                        <select class="select" name="blood_group">
                            <option value="">--Select Blood Group--</option>
                            <option value="O" {{ ($patient->blood_group === 'O') ? 'selected' : '' }}>O</option>
                            <option value="A" {{ ($patient->blood_group === 'A') ? 'selected' : '' }}>A</option>
                            <option value="B" {{ ($patient->blood_group === 'B') ? 'selected' : '' }}>B</option>
                            <option value="AB" {{ ($patient->blood_group === 'AB') ? 'selected' : '' }}>AB</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Rhesus <span class="text-danger">*</span></label>
                        <select class="select" name="rhesus">
                                <option value="" >--Select Rhesus--</option>
                                <option value="+" {{ ($patient->rhesus === '+') ? 'selected' : '' }}>Positive</option>
                                <option value="-" {{ ($patient->rhesus === '-') ? 'selected' : '' }}>Négative</option>
                            </select>
                    </div>
                </div>

    				<div class="col-sm-6">
    					<div class="form-group">
    						<label>Address <span class="text-danger">*</span></label>
    						<input type="text" class="form-control " name="address" value="{{$patient->address}}">
    					</div>
    				</div>

                    <div class="col-sm-6">
    					<div class="form-group">
    						<label>Avatar</label>
    						<div class="profile-upload">
    							<div class="upload-img">
    								<img alt="" src="{{asset('/assets/assets/img/user.jpg')}}">
    							</div>
    							<div class="upload-input">
    								<input type="file" class="form-control" name="profile_picture" value="{{$patient->profile_picture}}">
    							</div>
    						</div>
    					</div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="display-block">Status</label>
            				<div class="form-check form-check-inline">
            					<input class="form-check-input" type="radio" name="status" id="patient_active" value="1" {{  $patient->status == 1 ? 'checked' : '' }} >
            					<label class="form-check-label" for="patient_active">
            					Actif
            					</label>
            				</div>
            				<div class="form-check form-check-inline">
            					<input class="form-check-input" type="radio" name="status" id="patient_inactive" value="0" {{  $patient->status == 0 ? 'checked' : '' }} >
            					<label class="form-check-label" for="patient_inactive">
            					Inactif
            					</label>
            				</div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <div class="m-t-20 text-center">
                    <button class="btn btn-primary submit-btn">Edit Patient</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection