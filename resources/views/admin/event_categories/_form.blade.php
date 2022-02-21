@include('shared.errors')

<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="form-control-label" for="name">Nome</label>
			<input type="text" name="name" value="{{ old('name') ? old('name') : @$event_category->name }}" class="form-control" required>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="form-control-label" for="type">Categoria</label>
			<select name="type" class="form-control">
				@foreach(range(0, 1) as $option)
					<option value="{{ $option }}" {{ @$event_category->type == $option ? 'selected' : NULL }}>{{ \App\Enums\EventCategoryType::getDescription($option) }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>

<div class="form-group">
	<label class="form-control-label" for="description">Descrição</label>
	<textarea name="description" class="form-control" rows="4">{{ old('description') ? old('description') : @$event_category->description }}</textarea>
</div>

<div class="pt-5 text-right">
	<input class="btn btn-info px-5" type="submit" value="Salvar">
</div>