@extends('layouts.dashboard')

@section('content')

@include('admin.events._page_header')

<div class="container-fluid">
	@include('shared.flash_messages')
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover v-middle">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nome</th>
							<th scope="col">Usuário</th>
							<th scope="col">Profissional</th>
							<th scope="col">Data/Hora</th>
							<th class="text-center">Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach($events as $key => $event)
							<tr>
								<th scope="row">{{ $event->id }}</th>
								<td>{{ $event->name }}</td>
								<td>{{ $event->user->name }}</td>
								<td>{{ $event->professional->name }}</td>
								<td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y').' - '.\Carbon\Carbon::parse($event->start_hour)->format('H:i') }}</td>
								<td class="text-center"><button type="button" class="btn btn-info btn-sm px-3 show-item" data-toggle="modal" data-target="#modal-show" data-url="{{ route('admin.events.show', $event->slug) }}" data-large="true" data-title="Visualizar"><i class="fas fa-eye"></i> Visualizar</button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{{ $events->links() }}
			</div>
		</div>
	</div>
</div>
@endsection