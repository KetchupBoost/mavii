<form action="{{ route('event_applications.update', [$event_application->event->id, $event_application->id]) }}" method="post" onsubmit="saveEventApplication(this, event)">
	@method('PATCH')
	@csrf
	@include('event_applications._form')
</form>