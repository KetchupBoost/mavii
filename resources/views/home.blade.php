@extends('layouts.site')

@section('content')
	<div class="specialties py-5">
		<div class="container">
			<h3 class="section-title mb-5">
				<span>Categorias</span> em destaque
				<hr>
			</h3>

			@php
        $count = 1;
      @endphp
			@foreach($specialties as $key => $specialty)
				@if($count%3 == 1)
          <div class="row">
        @endif
        	<div class="col-sm-4">
						<a href="{{ route('specialties.show', $specialty->slug) }}" class="specialties__item card">
							<div class="card-body">
								<span class="specialties__item-icon">
									<i class="{{ $specialty->icon }} fa-2x fa-fw"></i>
								</span>
								<hr class="specialties__item-line">
								<h4 class="specialties__item-title">{{ $specialty->name }}</h4>
								<p class="specialties__item-description">{{ $specialty->description }}</p>
							</div>
						</a>
					</div>
        @if($count%3 == 0)
          </div>
        @endif
        @php
          $count++;
        @endphp
			@endforeach
			@if($count%3 != 1)
        </div>
      @endif
		</div>
	</div>

	<div class="users py-5">
		<div class="container">
			<h3 class="section-title mb-5">
				<span>Profissionais</span> em destaque
				<hr>
			</h3>

			<div class="users">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						@foreach($users as $key => $user)
							<div class="swiper-slide">
								<div class="users__item card">
									<div class="card-body">
										<a href="{{ route('users.show', $user->slug) }}" class="users__item-avatar" style="background: url('{{ !$user->avatar ? asset('public/img/avatar.png') : Storage::url($user->avatar) }}'); background-size: cover;"></a>
										<h4 class="users__item-name">
											<a href="{{ route('users.show', $user->slug) }}">{{ !$user->display_name ? $user->name : $user->display_name }}</a>
										</h4>
										<p class="users__item-services">
											@foreach($user->user_subspecialties as $key => $user_subspecialty)
												<a href="{{ route('subspecialties.show', [$user_subspecialty->subspecialty->specialty->slug, $user_subspecialty->subspecialty->slug]) }}">{{ $user_subspecialty->subspecialty->name }}</a>
											@endforeach
										</p>
										<a href="{{ route('users.show', $user->slug) }}" class="btn btn-dark btn-sm" style="position: absolute; bottom: 1.25rem; left: 1.25rem; right: 1.25rem;">Ver Perfil</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			var images = [];

			@foreach($subspecialties as $key => $subspecialty)
				images.push('{{ !$subspecialty->cover ? 'https://place-hold.it/1920x1080' : Storage::url($subspecialty->cover) }}')
			@endforeach

			$('#header').css({
      	'background': 'url(' + images[0] + ') no-repeat',
      	'background-size': 'cover',
      	'transition': 'background-image 1s ease-in-out'
      });

			setInterval(switchImage, 5000);

			var i = 0;
			
			function switchImage() {
        $('#header').css({
        	'background': 'url(' + images[i] + ') no-repeat',
        	'background-size': 'cover',
        	'transition': 'background-image 1s ease-in-out'
        });

				i = i + 1;
				if (i == images.length) {
					i = 0;
				}
			};
		}, false);
	</script>
@endpush