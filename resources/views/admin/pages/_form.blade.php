@include('shared.errors')

<div class="form-group">
	<label class="form-control-label required" for="title">Título</label>
	<input type="text" name="title" value="{{ old('title') ? old('title') : @$page->title }}" class="form-control" required>
</div>

<div class="form-group">
	<label class="form-control-label required" for="body">Conteúdo</label>
	<textarea name="body" class="summernote" rows="4" required>{{ old('body') ? old('body') : @$page->body }}</textarea>
</div>

<div class="pt-5 text-right">
	<input class="btn btn-info px-5" type="submit" value="Salvar">
</div>