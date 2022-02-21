@extends('layouts.site')

@section('content')
	<div class="page specialty py-5">
		<div class="container">
			<h3 class="section-title mb-5">
				<span>{{ $title }}</span>
				<hr>
			</h3>

			<div class="users">
				<div class="row">
					<div class="col-sm-4">
						@include('shared.sidebar_site')
					</div>
					<div class="col-sm-8">
						@include('users._list')
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

