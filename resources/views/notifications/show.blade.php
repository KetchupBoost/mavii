{!! $notification->description !!}

<div class="pt-3 text-right">
	@if($notification->link)
		<a href="{{ $notification->link }}" class="btn btn-outline-dark btn-sm px-4">Veja</a>
	@endif
</div>
