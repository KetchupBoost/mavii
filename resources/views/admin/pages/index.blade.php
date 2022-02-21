@extends('layouts.dashboard')

@section('content')

@include('admin.pages._page_header')

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
							<th scope="col">Criado em</th>
							<th scope="col"></th>
							<th colspan="3" class="text-center">Ações</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pages as $key => $page)
							<tr>
								<th scope="row">{{ $page->id }}</th>
								<td>{{ $page->title }}</td>
								<td>{{ \Carbon\Carbon::parse($page->created_at)->format('d/m/Y').' - '.\Carbon\Carbon::parse($page->created_at)->format('H:i') }}</td>
								<td>
									<label class="form-switch" onchange="updateStatus(this, event)" data-token="{{ csrf_token() }}" data-controller="pages" data-id="{{ $page->id }}">
										<input type="checkbox" name="status" id="page_{{ $page->id }}" tabindex="1" {{ !$page->status ? 'value=1' : 'value=0 checked' }}>
										<i></i>
									</label>
								</td>
								<td class="text-center"><button type="button" class="btn btn-info btn-sm px-3 show-item" data-toggle="modal" data-target="#modal-show" data-url="{{ route('admin.pages.show', $page->slug) }}"><i class="fas fa-eye"></i> Visualizar</button></td>
								<td class="text-center"><a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-warning btn-sm px-3"><i class="fas fa-edit"></i> Editar</a></td>
								<td class="text-center"><button type="button" class="btn btn-danger btn-sm px-3 delete" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('admin.pages.destroy', $page->id) }}"><i class="fas fa-trash-alt"></i> Apagar</button></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				{{ $pages->links() }}
			</div>
		</div>
	</div>
</div>
@endsection