@if(!$users->isEmpty())
	@php
	  $count = 1;
	@endphp
	@foreach($users as $key => $user)
		@if($count%3 == 1)
	    <div class="row">
	  @endif
	  	<div class="col-sm-4">
		  	<div class="users__item card mb-4">
					<div class="card-body">
						<a href="{{ route('users.show', $user->slug) }}" class="users__item-avatar" style="background: url('{{ !$user->avatar ? asset('public/img/avatar.png') : Storage::url($user->avatar) }}'); background-size: cover;"></a>
						<h4 class="users__item-name">
							<a href="{{ route('users.show', $user->slug) }}">{{ !$user->display_name ? $user->name : $user->display_name }}</a>
						</h4>
						<p class="users__item-services">
							@foreach($user->user_subspecialties as $key => $user_subspecialty)
								<a href="#">{{ $user_subspecialty->subspecialty->name }}</a>
							@endforeach
						</p>
						<a href="{{ route('users.show', $user->slug) }}" class="btn btn-dark btn-sm" style="position: absolute; bottom: 1.25rem; left: 1.25rem; right: 1.25rem;">Ver Perfil</a>
					</div>
				</div>
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
@else
	<p class="mb-0 text-center">Nenhum profissional encontrado.</p>
@endif