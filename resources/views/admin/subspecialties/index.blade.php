@extends('layouts.dashboard')

@section('content')

@include('admin.subspecialties._page_header')

<div class="container-fluid">
	@include('shared.flash_messages')
			
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover v-middle">
					<thead>
						<tr>
							<th scope="col">Nome</th>
							<th scope="col"></th>
							<th scope="col"></th>
							<th colspan="2" class="text-center">Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach($subspecialties as $key => $subspecialty)
							<tr>
								<td>{{ $subspecialty->name }}</td>
								<td>
									<label class="form-switch" onchange="updateStatus(this, event)" data-token="{{ csrf_token() }}" data-controller="subspecialties" data-id="{{ $specialty->id }}">
										<input type="checkbox" name="status" id="subspecialty_{{ $subspecialty->id }}" tabindex="1" {{ !$subspecialty->status ? 'value=1' : 'value=0 checked' }}>
										<i></i>
									</label>
								</td>
								<td>
									<a class="featured" style="cursor: pointer;" onclick="updateFeatured(this)" data-token="{{ csrf_token() }}" data-controller="subspecialties" data-id="{{ $subspecialty->id }}" data-value="{{ $subspecialty->featured }}">
										@if(!$subspecialty->featured)
											<i class="far fa-star" aria-hidden="true"></i>
										@else
											<i class="fas fa-star" aria-hidden="true"></i>
										@endif
									</a>
								</td>
								<td class="text-center"><a href="{{ route('admin.specialties.subspecialties.edit', [$subspecialty->specialty->id, $subspecialty->id]) }}" class="btn btn-warning btn-sm py-0"><i class="fas fa-edit"></i> Editar</a></td>
								<td class="text-center"><button type="button" class="btn btn-danger btn-sm py-0 delete" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('admin.specialties.subspecialties.destroy', [$subspecialty->specialty->id, $subspecialty->id]) }}"><i class="fas fa-trash-alt"></i> Apagar</button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				@if(!request()->get('keyword'))
					{{ $subspecialties->links() }}
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
