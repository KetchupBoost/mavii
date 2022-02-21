@extends('layouts.dashboard')

@section('content')

@include('admin.pages._page_header')

<div class="container-fluid">
	<div class="card">
		<div class="card-body">
			<form action="{{ route('admin.pages.update', $page->id) }}" method="post">
				<div class="form-body">
					@method('PATCH')
					@csrf
					@include('admin.pages._form')
				</div>
			</form>
		</div>
	</div>
</div>
@endsection