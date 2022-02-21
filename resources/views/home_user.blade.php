@extends('layouts.site')

@section('content')
<div class="py-5 page events">
	<div class="container">
	  <h3 class="section-title mb-5">
			<span>{{ auth()->user()->hasRole('profissional') ? 'Eventos próximos' : 'Profissionais próximos' }}</span>
			<hr>
		</h3>

		@role('profissional')
			@if(!$events->isEmpty())
				@include('events._list')
			@else
				<p class="text-center">Nenhuma solicitação por perto.</p>
			@endif
		@endrole
	</div>
</div>
@endsection
