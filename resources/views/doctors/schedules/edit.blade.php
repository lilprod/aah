		

		<form action="{{route('bulk_schedules_update')}}" method="POST">
			@csrf
			<div class="hours-info">
				<div class="row form-row hours-cont">

					@foreach($schedules as $key=>$schedule)


					<div class="col-12 col-md-12">

						<div class="row form-row" id="row{{$key}}">
							<div class="col-12 col-md-5">

								<input type="hidden" class="form-control" name="day_num" id="day_num" value="{{$id}}">

								<div class="form-group">
									<label>Start Time</label>
									<select class="form-control" name="begin_time[]" id="begin_time" required>

										<option value = "07:00" {{ ($schedule->begin_time === '07:00:00') ? 'selected' : '' }}>07:00</option>
			                            <option value="08:00" {{ ($schedule->begin_time === '08:00:00') ? 'selected' : '' }}>08:00</option>
			                            <option value = "09:00" {{ ($schedule->begin_time === '09:00:00') ? 'selected' : '' }}>09:00</option>
			                            <option value = "10:00" {{ ($schedule->begin_time === '10:00:00') ? 'selected' : '' }}>10:00</option>
			                            <option value = "11:00" {{ ($schedule->begin_time === '11:00:00') ? 'selected' : '' }}>11:00</option>
			                            <option value = "14:00" {{ ($schedule->begin_time === '14:00:00') ? 'selected' : '' }}>14:00</option>
			                            <option value = "15:00" {{ ($schedule->begin_time === '15:00:00') ? 'selected' : '' }}>15:00</option>
			                            <option value = "16:00" {{ ($schedule->begin_time === '16:00:00') ? 'selected' : '' }}>16:00</option>

									</select>
								</div> 
							</div>
							<div class="col-12 col-md-5">
								<div class="form-group">
									<label>End Time</label>
									<select class="form-control" name="end_time[]" id="end_time" required>
										<option value="07:30" {{ ($schedule->end_time === '07:30:00') ? 'selected' : '' }}>07:30</option>
			                            <option value="08:30" {{ ($schedule->end_time === '08:30:00') ? 'selected' : '' }}>08:30</option>
			                            <option value="09:30" {{ ($schedule->end_time === '09:30:00') ? 'selected' : '' }}>09:30</option>
			                            <option value="10:30" {{ ($schedule->end_time === '10:30:00') ? 'selected' : '' }}>10:30</option>
			                            <option value="11:30" {{ ($schedule->end_time === '11:30:00') ? 'selected' : '' }}>11:30</option>
			                            <option value="14:30" {{ ($schedule->end_time === '14:30:00') ? 'selected' : '' }}>14:30</option>
			                            <option value="15:30" {{ ($schedule->end_time === '15:30:00') ? 'selected' : '' }}>15:30</option>
			                            <option value="16:30" {{ ($schedule->end_time === '16:30:00') ? 'selected' : '' }}>16:30</option>
									</select>
								</div> 
							</div>

							<div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger btn_remove" id="{{$key}}"><i class="far fa-trash-alt"></i></a></div>
						</div>
					</div>

					@endforeach

				</div>

			</div>
			
			<div class="add-more mb-3">
				<a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
			</div>
			<div class="submit-section text-center">
				<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
			</div>
		</form>

		 <!-- Custom JS -->
        <script src="{{asset('assets/js/script.js') }}"></script>

        