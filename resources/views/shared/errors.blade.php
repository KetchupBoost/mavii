@if($errors)
	@foreach ($errors->all() as $error)
		<div class="alert alert-warning">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{{ $error }}
		</div>
	@endforeach
@endif