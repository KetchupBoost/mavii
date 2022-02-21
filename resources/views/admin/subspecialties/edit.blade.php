@extends('layouts.dashboard')

@section('content')

@include('admin.subspecialties._page_header')

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<form action="{{ route('admin.specialties.subspecialties.update', [$specialty_id, $subspecialty->id]) }}" method="post" enctype="multipart/form-data">
				<div class="form-body">
					@method('PATCH')
					@csrf
					@include('admin.subspecialties._form')
				</div>
			</form>
		</div>
	</div>
</div>
@endsection