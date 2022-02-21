@extends('layouts.dashboard')

@section('content')

@include('admin.specialties._page_header')

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
							<th scope="col">ícone</th>
							<th scope="col"></th>
							<th scope="col"></th>
							<th colspan="2" class="text-center">Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach($specialties as $key => $specialty)
							<tr>
								<th scope="row">{{ $specialty->id }}</th>
								<td>{{ $specialty->name }}</td>
								<td><i class="{{ $specialty->icon }} fa-lg fa-fw"></i></td>
								<td>
									<label class="form-switch" onchange="updateStatus(this, event)" data-token="{{ csrf_token() }}" data-controller="specialties" data-id="{{ $specialty->id }}">
										<input type="checkbox" name="status" id="specialty_{{ $specialty->id }}" tabindex="1" {{ !$specialty->status ? 'value=1' : 'value=0 checked' }}>
										<i></i>
									</label>
								</td>
								<td class="text-center"><a href="{{ route('admin.specialties.subspecialties.index', $specialty->id) }}" class="btn btn-light btn-sm px-3"><i class="fas fa-tools"></i> Subspecialidades</a></td>
								<td class="text-center"><a href="{{ route('admin.specialties.edit', $specialty->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</a></td>
								<td class="text-center"><button type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('admin.specialties.destroy', $specialty->id) }}"><i class="fas fa-trash-alt"></i> Apagar</button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				@if(!request()->get('keyword'))
					{{ $specialties->links() }}
				@endif
			</div>
		</div>
	</div>
</div>
@endsection