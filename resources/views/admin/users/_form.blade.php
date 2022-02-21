@include('shared.errors')

@role('admin')
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label class="form-control-label" for="name">Nome</label>
				<input type="text" name="name" value="{{ old('name') ? old('name') : @$user->name }}" class="form-control" required>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label class="form-control-label" for="name">Perfil de Acesso</label>
				<select name="role" class="form-control">
					@foreach($roles as $option)
						<option value="{{ $option->name }}" {{ in_array($option->id, $roles->toArray()) ? 'selected' : NULL }}>{{ $option->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
@else
	<div class="form-group">
		<label class="form-control-label" for="name">Nome</label>
		<input type="text" name="name" value="{{ old('name') ? old('name') : @$user->name }}" class="form-control" required>
	</div>
@endrole

<div class="row">
	<div class="col-sm-4">
		<div class="form-group">
			<label class="form-control-label" for="email">E-mail</label>
			<input type="email" name="email" value="{{ old('email') ? old('email') : @$user->email }}" class="form-control" required>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="form-control-label" for="phone">Telefone</label>
			<input type="text" name="phone" value="{{ old('phone') ? old('phone') : @$user->phone }}" class="form-control phone">
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="form-control-label" for="cellphone">Celular</label>
			<input type="text" name="cellphone" value="{{ old('cellphone') ? old('cellphone') : @$user->cellphone }}" class="form-control cellphone">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-4">
		<div class="form-group">
			<label class="form-control-label" for="birthdate">Data de Nascimento</label>
			<input type="text" name="birthdate" value="{{ old('birthdate') ? old('birthdate') : !@$user->birthdate ? NULL : \Carbon\Carbon::parse($user->birthdate)->format('d/m/Y') }}" class="form-control date datepicker-here" data-position="right top" data-auto-close="true" data-language="pt-BR">
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="form-control-label" for="gender">Sexo</label>
			<select name="gender" class="form-control">
				@foreach(range(0, 2) as $option)
					<option value="{{ $option }}" {{ @$user->gender == $option ? 'selected' : NULL }}>{{ \App\Enums\UserGender::getDescription($option) }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			<label class="form-control-label" for="cpf">CPF</label>
			<input type="text" name="cpf" value="{{ old('cpf') ? old('cpf') : @$user->cpf }}" class="form-control cpf">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label class="form-control-label" for="password">Senha</label>
			<input type="password" name="password" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group">
			<label class="form-control-label" for="confirm_password">Confirmar Senha</label>
			<input type="password" name="confirm_password" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
		</div>
	</div>
</div>

<label class="form-control-label" for="avatar">Avatar <small>Tamanho Máximo (300 &bull; 300 px)</small></label>
<div class="input-group">
	<input type="hidden" name="current_file" value="{{ @$user->avatar }}">
	<div class="custom-file">
		<input type="file" name="avatar" class="custom-file-input" accept="image/*">
		<label class="custom-file-label" for="avatar">{{ @$user->avatar ? basename(@$user->avatar) : 'Selecione um arquivo...' }}</label>
	</div>
</div>

<div class="row pt-5 pb-3 text-center">
	<div class="col-sm-6">
		<div class="custom-control custom-radio custom-control-inline">
		  <input type="radio" id="status_active" name="status" value="1" class="custom-control-input" {{ @$user->status == 1 ? 'checked' : null }}>
		  <label class="custom-control-label" for="status_active">Ativo</label>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="custom-control custom-radio custom-control-inline">
		  <input type="radio" id="approved_inactive" name="status" value="0" class="custom-control-input" {{ @$user->status == 0 ? 'checked' : null }}>
		  <label class="custom-control-label" for="approved_inactive">Inativo</label>
		</div>
	</div>
</div>

<div class="pt-5 text-right">
	<input class="btn btn-info px-5" type="submit" value="Salvar">
</div>