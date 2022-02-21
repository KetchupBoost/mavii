@foreach(['danger', 'warning', 'success', 'info'] as $msg)
	@if(Session::has($msg))
		<div class="alert alert-{{ $msg }}">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{{ Session::get($msg) }}
		</div>
	@endif
@endforeach