@extends('layouts.site')

@section('content')
<div class="py-5 page profile">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				@include('shared.sidebar_user')
			</div>
			<div class="col-sm-9">
				@include('shared.flash_messages')

				<div class="card">
					<div class="card-body">
						<h4 class="mb-4 text-center">{{ $title }}</h4>

						@include('shared.errors')

						<ul class="nav nav-tabs" id="myTab" role="tablist">
							@foreach($days as $key => $day)
								<li class="nav-item" role="presentation">
									<a class="nav-link {{ $key == 0 ? 'active' : NULL }}" id="{{ $day->slug }}-tab" data-toggle="tab" href="#{{ $day->slug }}" role="tab" aria-controls="{{ $day->slug }}" aria-selected="true">{{ $day->name }}</a>
								</li>
							@endforeach
						</ul>

						<div class="tab-content pt-4" id="nav-tabContent">
							@foreach($days as $key => $day)
								<div class="tab-pane fade {{ $key == 0 ? 'show active' : NULL }}" id="{{ $day->slug }}" role="tabpanel" aria-labelledby="{{ $day->slug }}-tab">
									<label class="form-switch" onchange="updateStatus(this, event)" data-token="{{ csrf_token() }}" data-controller="days" data-id="{{ $day->id }}">
										<input type="checkbox" name="status" id="day_{{ $day->id }}" tabindex="1" {{ !$day->status ? 'value=1' : 'value=0 checked' }}>
										<i></i>
										Marcar se atende ou não este dia da semana.
									</label>

									<hr class="mb-5">

									@php
										$count = 1;
									@endphp
									@foreach($day->hours as $key => $hour)
										@if($count%4 == 1)
											<div class="row">
										@endif
											<div class="col-sm-3 text-center">
												<div class="toggle-group" onchange="updateStatus(this, event)" data-token="{{ csrf_token() }}" data-controller="hours" data-id="{{ $hour->id }}">
													<input type="checkbox" name="status" id="hour_{{ $hour->id }}" tabindex="1" {{ !$hour->status ? 'value="1"' : 'value="0" checked' }}>
													<label for="hour_{{ $hour->id }}"></label>
													<div class="onoffswitch" aria-hidden="true">
														<div class="onoffswitch-label">
															<div class="onoffswitch-inner" data-text="{{ \Carbon\Carbon::createFromFormat('H:i:s', $hour->hour)->format('H:i') }}"></div>
															<div class="onoffswitch-switch"></div>
														</div>
													</div>
												</div>
											</div>
										@if($count%4 == 0)
											</div>
										@endif
										@php
											$count++;
										@endphp
									@endforeach
									@if($count%4 != 1)
										</div>
									@endif
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
