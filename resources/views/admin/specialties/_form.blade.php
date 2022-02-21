@include('shared.errors')

<div class="form-group">
	<label class="form-control-label" for="name">Nome</label>
	<input type="text" name="name" value="{{ old('name') ? old('name') : @$specialty->name }}" class="form-control" required>
</div>

<div class="form-group">
	<label class="form-control-label" for="description">Descrição</label>
	<textarea name="description" class="form-control" rows="4">{{ old('description') ? old('description') : @$specialty->description }}</textarea>
</div>

<label class="form-control-label" for="icon">Ícone</label>
<div class="input-group mb-3">
	<input type="text" name="icon" value="{{ old('icon') ? old('icon') : @$specialty->icon }}" class="form-control icp-auto" data-placement="topRight" required>
	<div class="input-group-append">
		<span class="input-group-text"><i class="fas fa-hand-pointer fa-fw"></i></span>
	</div>
</div>

<label class="form-control-label required" for="cover">Capa <small>Tamanho Máximo (800 &bull; 600 px)</small></label>
<div class="input-group">
	<input type="hidden" name="current_file" value="{{ @$specialty->cover }}">
	<div class="custom-file">
		<input type="file" name="cover" class="custom-file-input" accept="image/*">
		<label class="custom-file-label" for="cover">{{ @$specialty->cover ? basename(@$specialty->cover) : 'Selecione um arquivo...' }}</label>
	</div>
</div>

<div class="pt-5 text-right">
	<input class="btn btn-info px-5" type="submit" value="Salvar">
</div>