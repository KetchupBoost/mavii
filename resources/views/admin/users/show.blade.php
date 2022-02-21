<span class="badge badge-secondary">Nome</span>
<p>{{ $user->name }}</p>

<div class="row">
	<div class="col-sm-6">
		<span class="badge badge-secondary">E-mail</span>
		<p>{{ $user->email }}</p>
	</div>
	<div class="col-sm-3">
		<span class="badge badge-secondary">Telefone</span>
		<p>{{ $user->phone }}</p>
	</div>
	<div class="col-sm-3">
		<span class="badge badge-secondary">Celular</span>
		<p>{{ phone($user->cellphone, 'BR') }}</p>
	</div>
</div>

@if($user->address)
	<!-- Endereço -->
	<h5 class="section-title my-4">
		<span>Endereço</span>
	</h5>

	<div class="row">
		<div class="col-sm-3">
			<span class="badge badge-secondary">CEP</span>
			<p>{{ $user->address->postal_code }}</p>
		</div>
		<div class="col-sm-7">
			<span class="badge badge-secondary">Logradouro</span>
			<p>{{ $user->address->public_place }}</p>
		</div>
		<div class="col-sm-2">
			<span class="badge badge-secondary">Número</span>
			<p>{{ $user->address->street_number }}</p>
		</div>
	</div>

	@if($user->address->complement)
		<span class="badge badge-secondary">Complemento</span>
		<p>{{ $user->address->complement }}</p>
	@endif

	<div class="row">
		<div class="col-sm-6">
			<span class="badge badge-secondary">Bairro</span>
			<p>{{ $user->address->neighborhood }}</p>
		</div>
		<div class="col-sm-6">
			<span class="badge badge-secondary">Cidade/Estado</span>
			<p>{{ $user->address->city->name }} / {{ $user->address->city->state->name }}</p>
		</div>
	</div>
@endif

@if($user->devices)
	<!-- Dispositivos -->
	<h5 class="section-title my-4">
		<span>Dispositivos</span>
	</h5>

	@foreach($user->devices->sortByDesc('created_at') as $key => $device)
		<div class="row">
			<div class="col-sm-6">
				<span class="badge badge-secondary">Plataforma</span>
				<p>{{ ucfirst($device->platform) }}</p>
			</div>
			<div class="col-sm-6">
				<span class="badge badge-secondary">Criado em</span>
				<p>{{ \Carbon\Carbon::parse($device->created_at)->format('d/m/Y').' - '.\Carbon\Carbon::parse($device->created_at)->format('H:i') }}</p>
			</div>
		</div>
	@endforeach
@endif