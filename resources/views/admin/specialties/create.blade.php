@extends('layouts.dashboard')

@section('content')

@include('admin.specialties._page_header')

<div class="container-fluid">
	<div class="card-group">
		<div class="card border-right">
			<div class="card-body">
				<form action="{{ route('admin.specialties.store') }}" method="post" enctype="multipart/form-data">
					<div class="form-body">
						@csrf
						@include('admin.specialties._form')
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection