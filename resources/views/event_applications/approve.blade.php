<form action="{{ route('event_applications.update_approve', $event_application->id) }}" method="post" onsubmit="saveEventApplication(this, event)">
	@csrf

	<p class="text-center">Você concorda com o valor cobrado de <strong>@currency($event_application->event->price)</strong>?</p>

	<div class="radio-group mb-4">
    <label><input type="radio" name="status" value="2" required> Sim</label>
    <label><input type="radio" name="status" value="3"> Não</label>
  </div>
	
	<div class="overflow-hidden pt-4">
	  <button type="submit" class="btn btn-dark px-5 float-right btn-submit">Salvar</button>
	</div>
</form>