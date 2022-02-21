<span class="badge badge-secondary">Categoria</span>
<p>{{ $event->event_category->name }}</p>

<div class="row">
	<div class="col-sm-6">
		<span class="badge badge-secondary">Data</span>
		<p>{{ \Carbon\Carbon::parse($event->start_date)->format('d') }} de {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%B') }} de {{ \Carbon\Carbon::parse($event->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($event->start_hour)->format('H:i') }}</p>
	</div>
	<div class="col-sm-6">
		<span class="badge badge-secondary">Qt. de Pessoas</span>
		<p>{{ \App\Enums\EventPeopleAmount::getDescription($event->people_amount) }}</p>
	</div>
</div>

<span class="badge badge-secondary">Local</span>
<p>{{ $event->location }}</p>

<iframe src="https://www.google.com/maps/embed/v1/place?key={{ env('GOOGLE_API_KEY', 'default_value') }}&q={{ $event->lat.','.$event->lng }}" class="w-100 border rounded" style="height: 200px;" frameborder="0" allowfullscreen></iframe>

<span class="badge badge-secondary">Descrição</span>
<p>{{ $event->description }}</p>

<hr>

@foreach($event->event_logs as $key => $event_log)
	<p class="text-muted">{{ $event_log->description }}</p>
	<div class="text-right">
		<small class="font-italic"><i class="far fa-calendar fa-fw"></i> {{ \Carbon\Carbon::parse($event_log->start_date)->format('d') }} de {{ \Carbon\Carbon::parse($event_log->start_date)->formatLocalized('%B') }} de {{ \Carbon\Carbon::parse($event_log->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($event_log->start_hour)->format('H:i') }}</small>
	</div>
	@if(!$loop->last)
		<hr>
	@endif
@endforeach