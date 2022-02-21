@extends('layouts.site')

@section('content')
<div class="py-5 page notifications">
	<div class="container">
	  <h3 class="section-title mb-5">
			<span>{{ $title }}</span>
			<hr>
		</h3>

		@if(!$notifications->isEmpty())
			<div class="card mb-4">
				<div class="card-body">
					@foreach($notifications as $key => $notification)
						<a href="#" class="show-item" data-toggle="modal" data-target="#modal-show" data-url="{{ route('notifications.show', $notification->slug) }}" data-title="{{ $notification->title }}">
							<h6 class="text-dark font-weight-bold">{{ $notification->title }}</h6>
							<p class="text-muted mb-0">{{ $notification->description }}</p>
						</a>
						@if(!$loop->last)
							<hr>
						@endif
					@endforeach
				</div>
			</div>
		@else
			<p class="mb-5 text-center">Nenhuma nova notificação até o momento.</p>
		@endif

		<h5 class="line-title mb-5">
			<span style="background-color: #fcfcfc;">Notificações antigas</span>
		</h5>

		@if(!$old_notifications->isEmpty())
			<div class="card mb-4">
				<div class="card-body">
					@include('notifications._list')
				</div>
			</div>
		@else
			<p class="mb-5 text-center">Nada por aqui ainda.</p>
		@endif
	</div>
</div>
@endsection
