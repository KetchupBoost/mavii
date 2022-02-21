<fieldset>
	<div class="form-group">
	  <input type="text" name="name" value="{{ old('name') ? old('name') : @$event->name }}" class="form-control" placeholder="* Nome do Evento" required>
	</div>

	<div class="form-group">
		<textarea name="description" class="form-control" rows="4" placeholder="Descrição">{{ old('description') ? old('description') : @$event->description }}</textarea>
	</div>

	<div class="form-group">
		<select name="event_category_id" class="form-control" required>
			<option value="">Selecione uma Categoria</option>
			@foreach($event_categories as $option)
				<option value="{{ $option->id }}" {{ @$event->event_category_id == $option->id ? 'selected' : NULL }} data-type="{{ $option->type }}">{{ $option->name }}</option>
			@endforeach
		</select>
	</div>

	<div class="pt-4 text-right">
    <button type="button" class="btn btn-outline-dark px-5 btn-next"><i class="fas fa-angle-double-right fa-fw"></i> Próximo</button>
  </div>
</fieldset>

<fieldset style="display: none;">
	<input type="hidden" name="professional_id" value="{{ request()->get('user_id') }}">
	<input type="hidden" name="lat" value="{{ old('lat') ? old('lat') : @$event->lat }}" id="lat">
	<input type="hidden" name="lng" value="{{ old('lng') ? old('lng') : @$event->lng }}" id="lng">

	<div id="serviceTypeInputs" class="row">
		<div class="col-sm-6">
			<div class="form-group">
			  <input type="text" name="start_date" value="{{ old('start_date') ? old('start_date') : !@$event->start_date ? NULL : \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}" class="form-control date" placeholder="* Data" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				@if(!request()->get('user_id'))
					<input type="text" name="start_hour" value="{{ old('start_hour') ? old('start_hour') : !@$event->start_hour ? NULL : \Carbon\Carbon::parse($event->start_hour)->format('H:i') }}" class="form-control hour" placeholder="* Horário" required>
				@else
					<select name="start_hour" class="form-control" required>
						<option value="">Selecione um Horário</option>
					</select>
				@endif
			</div>
		</div>
	</div>

	<div id="eventTypeInputs" class="row">
		<div class="col-sm-4">
			<div class="form-group">
			  <input type="text" name="start_date" value="{{ old('start_date') ? old('start_date') : !@$event->start_date ? NULL : \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }}" class="form-control date" placeholder="* Data" required>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
				<select name="start_hour" class="form-control" required>
					<option value="">Selecione um Horário</option>
				</select>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="form-group">
			  <select name="people_amount" class="form-control">
					@foreach(range(0, 4) as $option)
						<option value="{{ $option }}" {{ @$event->people_amount == $option ? 'selected' : NULL }}>{{ \App\Enums\EventPeopleAmount::getDescription($option) }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div id="errorWrapper"></div>

	<div class="form-group">
	  <input type="text" name="location" value="{{ old('location') ? old('location') : @$event->location }}" id="location" class="form-control" placeholder="* Localização" required>
	</div>

	<div id="map" class="mb-3 border rounded" style="height: 200px;"></div>

	<div class="overflow-hidden pt-4">
		<button type="button" class="btn btn-outline-dark px-5 btn-previous"><i class="fas fa-angle-double-left fa-fw"></i> Voltar</button>
	  <button type="submit" class="btn btn-dark px-5 float-right btn-submit">Finalizar</button>
	</div>
</fieldset>