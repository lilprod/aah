

<div class="chat_box" id="chat_box" style="display: none;">

	<div class="chat-header">
		<a id="back_user_list close-chat" href="javascript:void(0)" class="back-user-list ">
			<i class="material-icons">chevron_left</i>
		</a>
		<div class="media">
			<div class="media-img-wrap">
				<div class="avatar avatar-online">
					<img src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image" class="avatar-img rounded-circle">
				</div>
			</div>
			<div class="media-body">
				<div class="user-name">Dr. Darren Elder</div>
				<div class="user-status">online</div>
			</div>
		</div>
		<div class="chat-options">
			<a href="javascript:void(0)" data-toggle="modal" data-target="#voice_call">
				<i class="material-icons">local_phone</i>
			</a>
			<a href="javascript:void(0)" data-toggle="modal" data-target="#video_call">
				<i class="material-icons">videocam</i>
			</a>
			<a href="javascript:void(0)">
				<i class="material-icons">more_vert</i>
			</a>
		</div>
	</div>

	<div class="chat-body ">
		<div class="chat-scroll chat-area">
			<ul class="list-unstyled">

			</ul>
		</div>
	</div>

	<div class="chat-footer" >
		<div class="input-group form-controls">
			<div class="input-group-prepend">
				<div class="btn-file btn">
					<i class="fa fa-paperclip"></i>
					<input type="file">
				</div>
			</div>

			<input type="text" class="input-msg-send form-control chat_input" placeholder="Type something">
			<div class="input-group-append">
				<button type="button" class="btn msg-send-btn btn-chat" data-to-user="" disabled><i class="fab fa-telegram-plane"></i></button>
			</div>
		</div>	
	</div>

	<input type="hidden" id="to_user_id" value="" />
</div>

