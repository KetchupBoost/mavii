@foreach($events as $key => $event)
	<div class="events__item card mb-4">
		<div class="card-body">
			<div class="row">
				<div class="col-sm-4">
					<a href="{{ route('events.show', $event->slug) }}"><img src="{{ !$event->cover ? 'https://ui-avatars.com/api/?name='.$event->name.'&background=555&color=fff&size=800' : Storage::url($event->cover) }}" class="img-fluid rounded"></a>
				</div>
				<div class="col-sm-8">
					<h4 class="events__item-title"><a href="{{ route('events.show', $event->slug) }}">{{ $event->name }}</a></h4>
					<p class="events__item-details">
						<small>
							<i class="fas fa-tag fa-fw"></i> {{ $event->event_category->name }}
						</small>
						<small>
							<i class="far fa-calendar fa-fw"></i> {{ \Carbon\Carbon::parse($event->start_date)->format('d') }} de {{ \Carbon\Carbon::parse($event->start_date)->formatLocalized('%B') }} de {{ \Carbon\Carbon::parse($event->start_date)->format('Y') }} - {{ \Carbon\Carbon::parse($event->start_hour)->format('H:i') }}
						</small>
						@if(auth()->user()->hasRole('profissional') && $event->professional_id == auth()->user()->id)
							<small>
								<i class="fas fa-map-marker-alt fa-fw"></i> {{ $event->location }}
							</small>
						@endif
						@if($event->people_amount != NULL)
							<small>
								<i class="fas fa-users fa-fw"></i> {{ \App\Enums\EventPeopleAmount::getDescription($event->people_amount) }}
							</small>
						@endif
					</p>
					<p>{{ $event->description }}</p>
					@if($event->professional)
						<p><span class="events__item-avatar" style="background: url('{{ !$event->professional->avatar ? asset('public/img/avatar.png') : Storage::url($event->professional->avatar) }}'); background-size: contain;"></span> {{ $event->professional->name }}</p>
					@endif
				</div>
			</div>

			<hr class="mt-4">

			@if($event->status == '1')
				<p class="mb-0">
					@if(auth()->user()->hasRole('profissional') && $event->event_application)
						<i class="fas fa-exclamation-triangle fa-fw text-muted"></i> Evento aguardando você aceitar. <a href="#" class="edit-item" data-toggle="modal" data-target="#modal-edit" data-url="{{ route('event_applications.edit', [$event->id, $event->event_application->id]) }}" data-title="Aceitar Evento">Clique aqui</a> para fazer isso agora.
					@endif
					@if(auth()->user()->hasRole('profissional') && !$event->professional_id)
						<a href="#" class="btn btn-dark px-5 create-item" data-toggle="modal" data-target="#modal-create" data-url="{{ route('event_applications.create', $event->id) }}" data-title="Me Candidatar">Me Candidatar</a>
					@endif
					@role('cliente')
						<a href="#" class="d-block float-right list-items text-dark" data-toggle="modal" data-target="#modal-list" data-url="{{ route('event_logs.index', $event->id) }}" data-title="{{ $event->name }}"><i class="fas fa-clock fa-fw"></i> Histórico</a>
					@endrole
				</p>
			@elseif($event->status == '2')
				<p class="mb-0">
					@if(auth()->user()->hasRole('profissional') && $event->event_application)
						<i class="fas fa-check fa-fw text-success"></i> Você aceitou prestar serviço neste evento.
					@endif
					@role('cliente')
						<i class="fas fa-exclamation-triangle fa-fw text-muted"></i> Evento aceito pelo profissional. <a href="#" class="edit-item" data-toggle="modal" data-target="#modal-edit" data-url="{{ route('event_applications.approve', [$event->id, $event->event_application->id]) }}" data-title="Aprovar Profissional">Clique aqui</a> para fazer confirmar.
						<a href="#" class="d-block float-right list-items text-dark" data-toggle="modal" data-target="#modal-list" data-url="{{ route('event_logs.index', $event->id) }}" data-title="{{ $event->name }}"><i class="fas fa-clock fa-fw"></i> Histórico</a>
					@endrole
				</p>
			@else
				<p class="mb-0">
					<i class="fas fa-check fa-fw text-success"></i> Tudo certo pro dia do evento.
				</p>
			@endif
		</div>
	</div>
@endforeach