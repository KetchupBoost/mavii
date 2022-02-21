@include('shared.errors')

<div class="form-group">
	<label class="form-control-label" for="name">Nome</label>
	<input type="text" name="name" value="{{ old('name') ? old('name') : @$subspecialty->name }}" class="form-control" required>
</div>

<div class="form-group">
	<label class="form-control-label" for="description">Descrição</label>
	<textarea name="description" class="form-control" rows="4">{{ old('description') ? old('description') : @$subspecialty->description }}</textarea>
</div>

<label class="form-control-label required" for="cover">Capa <small>Tamanho Máximo (1920 &bull; 1080 px)</small></label>
<div class="input-group">
	<input type="hidden" name="current_file" value="{{ @$subspecialty->cover }}">
	<div class="custom-file">
		<input type="file" name="cover" class="custom-file-input" accept="image/*">
		<label class="custom-file-label" for="cover">{{ @$subspecialty->cover ? basename(@$subspecialty->cover) : 'Selecione um arquivo...' }}</label>
	</div>
</div>

<div class="pt-5 text-right">
	<input class="btn btn-info px-5" type="submit" value="Salvar">
</div>