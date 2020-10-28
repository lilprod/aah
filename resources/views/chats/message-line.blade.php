@if($message->from_user == \Auth::user()->id)

<li class="media sent" data-message-id="{{ $message->id }}">
		<div class="media-body">
			<div class="msg-box">
				<div>
					<p>{!! $message->content !!}</p>
					<ul class="chat-msg-info">
						<li>
							<div class="chat-time">
								<!--<span>8:30 AM</span>-->
								<time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</li>

@else

<li class="media received" data-message-id="{{ $message->id }}">
		<div class="avatar">
			<img src="assets/img/doctors/doctor-thumb-02.jpg" alt="User Image" class="avatar-img rounded-circle">
		</div>
		<div class="media-body">
			<div class="msg-box">
				<div>
					<p>{!! $message->content !!}</p>
					<ul class="chat-msg-info">
						<li>
							<div class="chat-time">
								<!--<span>8:55 PM</span>-->
								<time datetime="{{ date("Y-m-dTH:i", strtotime($message->created_at->toDateTimeString())) }}">{{ $message->fromUser->name }} • {{ $message->created_at->diffForHumans() }}</time>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</li>

@endif
