@include('shared.errors')

<div class="form-group">
	<label class="form-control-label" for="name">Nome</label>
	<input type="text" name="name" value="{{ old('name') ? old('name') : @$role->name }}" class="form-control" {{ in_array(@$role->name, ['admin', 'proprietario', 'cliente']) ? 'readonly' : NULL }} required>
</div>

@foreach($permissions as $permission)
	<div class="mb-3">
		<label class="form-switch">
			<input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, $role_permissions) ? 'checked' : NULL }}>
			<i></i>
			{{ ucfirst($permission->name) }}
		</label>
	</div>
@endforeach

<div class="pt-5 text-right">
	<input class="btn btn-info px-5" type="submit" value="Salvar">
</div>