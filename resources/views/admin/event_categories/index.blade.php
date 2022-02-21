@extends('layouts.dashboard')

@section('content')

@include('admin.event_categories._page_header')

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
							<th scope="col"></th>
							<th colspan="2" class="text-center">Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach($event_categories as $key => $event_category)
							<tr>
								<th scope="row">{{ $event_category->id }}</th>
								<td>{{ $event_category->name }}</td>
								<td>
									<label class="form-switch" onchange="updateStatus(this, event)" data-token="{{ csrf_token() }}" data-controller="event_categories" data-id="{{ $event_category->id }}">
										<input type="checkbox" name="status" id="event_category_{{ $event_category->id }}" tabindex="1" {{ !$event_category->status ? 'value=1' : 'value=0 checked' }}>
										<i></i>
									</label>
								</td>
								<td class="text-center"><a href="{{ route('admin.event_categories.edit', $event_category->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</a></td>
								<td class="text-center"><button type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('admin.event_categories.destroy', $event_category->id) }}"><i class="fas fa-trash-alt"></i> Apagar</button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				@if(!request()->get('keyword'))
					{{ $event_categories->links() }}
				@endif
			</div>
		</div>
	</div>
</div>
@endsection