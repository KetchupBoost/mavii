@extends('layouts.dashboard')

@section('content')

<div class="page-breadcrumb">
	<h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ $title }}</h4>
</div>

<div class="container-fluid">
	@include('shared.flash_messages')
	
	<div class="card-group">
		<div class="card border-right">
			<div class="card-body">
				<form action="{{ route('admin.info.update', $info->id) }}" method="post">
					<div class="form-body">
						@method('PATCH')
						@csrf
						@include('admin.info._form')
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection