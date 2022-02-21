<form action="{{ route('events.store') }}" method="post" class="form-step" onsubmit="saveEvent(this, event)">
	@csrf
	@include('events._form')
</form>
