@extends('layouts.dashboard')

@section('content')

@include('admin.users._page_header')

<div class="container-fluid">
	@include('shared.flash_messages')
	
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-hover v-middle">
					<thead>
						<tr>
							<th scope="col">Nome/E-mail</th>
							<th scope="col">Criado em</th>
							<th colspan="3" class="text-center">Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $key => $user)
							<tr>
								<td>
									<div class="d-flex no-block align-items-center">
										<div class="mr-3">
											<img src="{{ !$user->avatar ? 'https://ui-avatars.com/api/?name='.$user->name.'&background=555&color=fff' : Storage::url($user->avatar) }}" class="img-fluid rounded-circle" style="width: 64px; height: 64px; object-fit: cover;">
										</div>
										<div>
											<h5 class="text-dark mb-0 font-16 font-weight-medium">{{ $user->name }}</h5>
											<span class="text-muted font-14">{{ $user->email }}</span>
										</div>
									</div>
								</td>
								<td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y').' - '.\Carbon\Carbon::parse($user->created_at)->format('H:i') }}</td>
								<td class="text-center"><button type="button" class="btn btn-info btn-sm px-3 show-item" data-toggle="modal" data-target="#modal-show" data-url="{{ route('admin.users.show', $user->slug) }}" data-large="true" data-title="Visualizar"><i class="fas fa-eye"></i> Visualizar</button></td>
								<td class="text-center"><a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm px-3"><i class="fas fa-edit"></i> Editar</a></td>
								<td class="text-center"><button type="button" class="btn btn-danger btn-sm px-3 delete" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('admin.users.destroy', $user->id) }}"><i class="fas fa-trash-alt"></i> Apagar</button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection