@extends('layouts.dashboard')

@section('content')

@include('admin.event_categories._page_header')

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<form action="{{ route('admin.event_categories.update', $event_category->id) }}" method="post">
				<div class="form-body">
					@method('PATCH')
					@csrf
					@include('admin.event_categories._form')
				</div>
			</form>
		</div>
	</div>
</div>
@endsection