<nav class="navbar navbar-expand-md navbar-light py-4">
	<div class="container-fluid">
		<a class="navbar-brand" href="{{ url('/') }}"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav">
				<li class="nav-item dropdown justify-content-center mx-4">
					<a id="specialtiesDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						<i class="fas fa-bars fa-lg fa-fw"></i>
					</a>

					<div class="dropdown-menu" aria-labelledby="specialtiesDropdown">
						@foreach($specialties as $key => $specialty)
							<div class="dropdown-submenu">
								<a class="dropdown-item" href="{{ route('specialties.show', $specialty->slug) }}">{{ $specialty->name }}</a>

								<div class="dropdown-menu">
									@foreach($specialty->subspecialties as $key => $subspecialty)
										<a class="dropdown-item" href="{{ route('subspecialties.show', [$subspecialty->specialty->slug, $subspecialty->slug]) }}">{{ $subspecialty->name }}</a>
									@endforeach
								</div>
							</div>
						@endforeach
					</div>
				</li>
			</ul>
			<form action="{{ route('users.index') }}" method="get" class="form-inline inner-addon left-addon">
				<i class="fas fa-search"></i>
				<input type="search" name="keyword" value="{{ request()->get('keyword') }}" class="form-control" placeholder="Pesquisar" aria-label="Pesquisar" style="width: 300px;">
			</form>

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@guest
					<li class="nav-item mx-4">
						<a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt fa-fw"></i> Entrar</a>
					</li>
					@if (Route::has('register'))
						<li class="nav-item ml-4">
							<a class="btn btn-{{ Route::current()->getName() == 'root' || Route::current()->getName() == 'home' ? 'light' : 'dark' }} px-4" href="{{ route('register') }}"><i class="fas fa-user-plus fa-fw"></i> Cadastrar</a>
						</li>
					@endif
				@else
					@role('cliente')
						<li class="nav-item mx-4">
							<a class="nav-link create-item" href="#" data-toggle="modal" data-target="#modal-create" data-url="{{ route('events.create') }}" data-title="Nova Solicitação" data-large="true"><i class="fas fa-plus fa-fw"></i> Nova Solicitação</a>
						</li>
					@endrole
					<li class="nav-item dropdown justify-content-center mx-4">
						<a id="notificationsDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							<i class="fas fa-bell fa-fw"></i> <span class="badge badge-{{ Route::current()->getName() == 'root' || Route::current()->getName() == 'home' ? 'light' : 'dark' }} rounded-circle" style="padding: 0.25em 0.5em;">{{ $notifications->count() }}</span> <span class="caret"></span>
						</a>

						<div class="dropdown-menu" aria-labelledby="notificationsDropdown">
							@if(!$notifications->isEmpty())
								@foreach($notifications as $key => $notification)
									@if(!$loop->last)
										<a href="#" class="dropdown-item py-3 border-bottom show-item" data-toggle="modal" data-target="#modal-show" data-url="{{ route('notifications.show', $notification->slug) }}" data-title="{{ $notification->title }}">
									@else
										<a href="#" class="dropdown-item py-3 show-item" data-toggle="modal" data-target="#modal-show" data-url="{{ route('notifications.show', $notification->slug) }}" data-title="{{ $notification->title }}">
									@endif
										<h6 class="font-weight-bold">{{ $notification->title }}</h6>
										<p class="mb-0">{{ Str::limit($notification->description, 30) }}</p>
									</a>
								@endforeach
							@else
								<span class="dropdown-item">Nenhuma nova notificação.</span>
							@endif
							<hr class="mx-auto w-75">
							<a href="{{ route('notifications.index') }}" class="dropdown-item text-center">
								<small><i class="fas fa-arrow-right fa-fw"></i></small> Ver Todas
							</a>
						</div>
					</li>
					<li class="nav-item dropdown justify-content-center ml-4">
						<a id="accountDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<div class="dropdown-menu" aria-labelledby="accountDropdown">
							<a class="dropdown-item" href="{{ route('users.edit', auth()->user()->id) }}">Minha Conta</a>
							<a class="dropdown-item" href="{{ route('events.index') }}">Meus Eventos</a>
							<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
														 document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>