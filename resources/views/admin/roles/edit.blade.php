@extends('layouts.dashboard')

@section('content')

@include('admin.roles._page_header')

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<form action="{{ route('admin.roles.update', $role->id) }}" method="post">
				<div class="form-body">
					@method('PATCH')
					@csrf
					@include('admin.roles._form')
				</div>
			</form>
		</div>
	</div>
</div>
@endsection