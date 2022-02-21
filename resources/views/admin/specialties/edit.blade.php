@extends('layouts.dashboard')

@section('content')

@include('admin.specialties._page_header')

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<form action="{{ route('admin.specialties.update', $specialty->id) }}" method="post" enctype="multipart/form-data">
				<div class="form-body">
					@method('PATCH')
					@csrf
					@include('admin.specialties._form')
				</div>
			</form>
		</div>
	</div>
</div>
@endsection