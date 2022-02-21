@extends('layouts.dashboard')

@section('content')

@include('admin.roles._page_header')

<div class="container-fluid">
	<div class="card-group">
		<div class="card border-right">
			<div class="card-body">
				<form action="{{ route('admin.roles.store') }}" method="post">
					<div class="form-body">
						@csrf
						@include('admin.roles._form')
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection