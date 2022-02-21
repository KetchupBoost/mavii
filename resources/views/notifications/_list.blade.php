@foreach($old_notifications as $key => $old_notification)
	<a href="#" class="show-item" data-toggle="modal" data-target="#modal-show" data-url="{{ route('notifications.show', $old_notification->slug) }}" data-title="{{ $old_notification->title }}">
		<h6 class="text-dark font-weight-bold">{{ $old_notification->title }}</h6>
		<p class="text-muted mb-0">{{ $old_notification->description }}</p>
		<div class="text-right">
			<small class="text-muted font-italic"><i class="far fa-calendar fa-fw"></i> {{ \Carbon\Carbon::parse($old_notification->start_date)->format('d') }} de {{ \Carbon\Carbon::parse($old_notification->start_date)->formatLocalized('%B') }} de {{ \Carbon\Carbon::parse($old_notification->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($old_notification->start_hour)->format('H:i') }}</small>
		</div>
	</a>
	@if(!$loop->last)
		<hr>
	@endif
@endforeach