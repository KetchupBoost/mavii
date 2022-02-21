@extends('layouts.dashboard')

@section('content')

@include('admin.roles._page_header')

<div class="container-fluid">
	@include('shared.flash_messages')
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover v-middle">
					<thead>
						<tr>
							<th scope="col">Nome</th>
							<th colspan="2" class="text-center">Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach($roles as $key => $role)
							<tr>
								<td>{{ $role->name }}</td>
								<td class="text-center"><a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</a></td>
								<td class="text-center"><button type="button" class="btn btn-danger btn-sm delete" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('admin.roles.destroy', $role->id) }}"><i class="fas fa-trash-alt"></i> Apagar</button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection