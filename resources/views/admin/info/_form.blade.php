@include('shared.errors')

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label" for="facebook">Facebook</label>
			<input type="text" name="facebook" value="{{ old('facebook') ? old('facebook') : @$info->facebook }}" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label" for="twitter">Twitter</label>
			<input type="text" name="twitter" value="{{ old('twitter') ? old('twitter') : @$info->twitter }}" class="form-control">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label" for="instagram">Instagram</label>
			<input type="text" name="instagram" value="{{ old('instagram') ? old('instagram') : @$info->instagram }}" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label" for="youtube">Youtube</label>
			<input type="text" name="youtube" value="{{ old('youtube') ? old('youtube') : @$info->youtube }}" class="form-control">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label" for="whatsapp">Whatsapp</label>
			<input type="text" name="whatsapp" value="{{ old('whatsapp') ? old('whatsapp') : @$info->whatsapp }}" class="form-control cellphone">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label" for="snapchat">Snapchat</label>
			<input type="text" name="snapchat" value="{{ old('snapchat') ? old('snapchat') : @$info->snapchat }}" class="form-control">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label required" for="email1">Email 1</label>
			<input type="email" name="email1" value="{{ old('email1') ? old('email1') : @$info->email1 }}" class="form-control" required>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label" for="email2">Email 2</label>
			<input type="email" name="email2" value="{{ old('email2') ? old('email2') : @$info->email2 }}" class="form-control">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label" for="phone1">Telefone 1</label>
			<input type="text" name="phone1" value="{{ old('phone1') ? old('phone1') : @$info->phone1 }}" class="form-control phone">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label" for="phone2">Telefone 2</label>
			<input type="text" name="phone2" value="{{ old('phone2') ? old('phone2') : @$info->phone2 }}" class="form-control phone">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label" for="cellphone1">Celular 1</label>
			<input type="text" name="cellphone1" value="{{ old('cellphone1') ? old('cellphone1') : @$info->cellphone1 }}" class="form-control cellphone">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="form-control-label" for="cellphone2">Celular 2</label>
			<input type="text" name="cellphone2" value="{{ old('cellphone2') ? old('cellphone2') : @$info->cellphone2 }}" class="form-control cellphone">
		</div>
	</div>
</div>

<div class="form-group">
	<label class="form-control-label" for="address">Endereço</label>
	<input type="text" name="address" value="{{ old('address') ? old('address') : @$info->address }}" class="form-control">
</div>

<div class="pt-5 text-right">
	<input class="btn btn-info px-5" type="submit" value="Salvar">
</div>