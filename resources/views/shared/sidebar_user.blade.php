<ul class="sidebar">
	@role('profissional')
		<li class="sidebar__item">
			<a href="{{ route('users.edit_profile') }}" class="sidebar__item-link {{ request()->segment(count(request()->segments())) == 'perfil' ? 'sidebar__item-link--active' : NULL }}">Perfil</a>
		</li>
		<li class="sidebar__item">
			<a href="{{ route('days.index') }}" class="sidebar__item-link {{ request()->segment(count(request()->segments())) == 'horarios' ? 'sidebar__item-link--active' : NULL }}">Horários</a>
		</li>
	@endrole
	<li class="sidebar__item">
		<a href="{{ route('users.edit') }}" class="sidebar__item-link {{ request()->segment(count(request()->segments())) == 'dados-pessoais' ? 'sidebar__item-link--active' : NULL }}">Dados Pessoais</a>
	</li>
	<li class="sidebar__item">
		<a href="{{ route('users.edit_password') }}" class="sidebar__item-link {{ request()->segment(count(request()->segments())) == 'alterar-senha' ? 'sidebar__item-link--active' : NULL }}">Alterar Senha</a>
	</li>
</ul>