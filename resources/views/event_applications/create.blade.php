<form action="{{ route('event_applications.store', $event_id) }}" method="post" class="form-step" onsubmit="saveEvent(this, event)">
	@csrf
	@include('event_applications._form')
</form>
