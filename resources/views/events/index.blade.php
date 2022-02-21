@extends('layouts.site')

@section('content')
<div class="py-5 page events">
	<div class="container">
	  <h3 class="section-title mb-5">
			<span>Meus Eventos</span>
			<hr>
		</h3>

		<div class="row">
			<div class="col-sm-3">
				@include('events._sidebar')
			</div>
			<div class="col-sm-9">
				@if(!$events->isEmpty())
					@include('events._list')
				@else
					@role('cliente')
						<p class="text-center">Nenhum evento criado até o momento.</p>
					@else
						<p class="text-center">Nenhum evento atendido até o momento.</p>
					@endrole
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
