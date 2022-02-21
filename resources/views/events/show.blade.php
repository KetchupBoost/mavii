@extends('layouts.site')

@section('content')
	<div class="page event py-5">
		<div class="container">
			<div class="card">
	  		<div class="card-header">
	  			<h1>{{ $title }}</h1>
	  			<p class="event__details">
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
					@if($event->professional)
						<p class="mb-0"><span class="event__avatar" style="background: url('{{ !$event->professional->avatar ? asset('public/img/avatar.png') : Storage::url($event->professional->avatar) }}'); background-size: contain;"></span> {{ $event->professional->name }}</p>
	  			@endif
	  		</div>

	  		<div class="card-body">
					<div class="row">
						<div class="col-sm-4">
							<img src="{{ !$event->cover ? 'https://ui-avatars.com/api/?name='.$event->name.'&background=555&color=fff&size=800' : Storage::url($event->cover) }}" class="img-fluid rounded">
						</div>
						<div class="col-sm-8">
							{{ $event->description }}
						</div>
					</div>
				</div>
			</div>

			@if(!$event->price && auth()->user()->id == $event->professional_id)
				<div class="p-4 mt-4 border rounded">
					<p>Você aceita prestar serviço neste evento?</p>
					<button type="button" class="btn btn-outline-dark btn-sm px-4 edit-item" data-toggle="modal" data-target="#modal-edit" data-url="{{ route('event_applications.edit', [$event->id, $event->event_application->id]) }}" data-title="Aceitar Evento"><i class="fas fa-check fa-fw"></i> Aceitar</button>
				</div>
			@endif
		</div>
	</div>
@endsection

