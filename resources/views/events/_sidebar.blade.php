<ul class="sidebar">
	<li class="sidebar__item">
		<a href="{{ route('events.index') }}" class="sidebar__item-link {{ request()->segment(count(request()->segments())) == 'eventos' ? 'sidebar__item-link--active' : NULL }}">Todos</a>
	</li>
</ul>