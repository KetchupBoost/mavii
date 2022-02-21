@foreach($event_logs as $key => $event_log)
	<p class="text-muted">{{ $event_log->description }}</p>
	<div class="text-right">
		<small class="font-italic"><i class="far fa-calendar fa-fw"></i> {{ \Carbon\Carbon::parse($event_log->start_date)->format('d') }} de {{ \Carbon\Carbon::parse($event_log->start_date)->formatLocalized('%B') }} de {{ \Carbon\Carbon::parse($event_log->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($event_log->start_hour)->format('H:i') }}</small>
	</div>
	@if(!$loop->last)
		<hr>
	@endif
@endforeach