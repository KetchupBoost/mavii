@extends('layouts.site')

@section('content')
<div class="py-5 page user">
	<div class="container">
	  <div class="card">
	  	<div class="card-header">
	  		<div class="row">
	  			<div class="col-sm-2 text-center">
	  				<img src="{{ !$user->avatar ? asset('public/img/avatar.png') : Storage::url($user->avatar) }}" class="img-fluid w-75">
	  			</div>
	  			<div class="col-sm-10">
	  				<h1 class="user__name">
	  					{{ !$user->display_name ? $user->name : $user->display_name }}
	  					<small><i class="fas fa-map-marker-alt fa-fw"></i> {{ $user->address->city->name }}, {{ $user->address->city->state->name }}</small>
	  				</h1>
	  				@guest
	  					<a href="{{ route('login') }}" class="btn btn-dark px-5">Contratar</a>
	  				@else
	  					@role('cliente')
	  						<button class="btn btn-dark px-5 create-item" type="button" data-toggle="modal" data-target="#modal-create" data-url="{{ route('events.create').'?user_id='.$user->id }}" data-title="Contratar {{ !$user->display_name ? $user->name : $user->display_name }}" data-large="true">Contratar</button>
	  					@endrole
	  				@endguest
	  			</div>
	  		</div>
	  	</div>
	  	<div class="card-body">
	  		<div class="row">
	  			<div class="col-sm-3">
	  				<h4 class="user__section-title">
	  					Especialidades
	  					<hr>
	  				</h4>

	  				<p class="user__services">
							@foreach($user->user_subspecialties as $key => $user_subspecialty)
								<a href="#">{{ $user_subspecialty->subspecialty->name }}</a>
							@endforeach
						</p>
	  			</div>
	  			<div class="col-sm-9">
	  				<h4 class="user__section-title">
	  					Sobre
	  					<hr>
	  				</h4>
	  				<p>{{ $user->bio }}</p>
	  			</div>
	  		</div>
	  	</div>
	  </div>
	</div>
</div>
@endsection

@push('scripts')
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			$(document).on('change', 'input[name="start_date"]', function(e) {
        var startDate = $(this).val(),
            select = $('select[name="start_hour"]');

        $('#errorWrapper').html(null);
        $('#errorWrapper').slideUp('slow');

        $.ajax({
          url: APP_URL + '/days/hours',
          type: 'GET',
          data: { start_date: startDate, user_id: '{{ $user->id }}' },
          success: function(result) {
            select.empty();

            if(!result) {
            	$('#errorWrapper').html('<div class="alert alert-warning" role="alert">Esta data não possui horários disponíveis, por favor selecione outra.</div>');
            	$('#errorWrapper').slideDown('slow');
            } else {
            	$.each(result, function(index, el) {
	            	if (!el.status) {
	            		select.append('<option value="' + el.hour + '" data-status="' + el.status + '">' + el.hour + ' (Indisponível)</option>');
	            	} else {
	            		select.append('<option value="' + el.hour + '" data-status="' + el.status + '">' + el.hour + '</option>');
	            	}
	            });
            }
          },
          error: function(xhr) {
            
          }
        });
      });

      $(document).on('change', 'select[name="start_hour"]', function(e) {
      	var status = $(this).find(':selected').data('status');

      	if (!status) {
      		$('#errorWrapper').html('<div class="alert alert-warning" role="alert">Este horário não está disponível na agenda do profissional, você pode prosseguir se quiser porém as chances de sua solicitação ser recusada são maiores.</div>').slideDown('slow');
      	} else {
      		$('#errorWrapper').slideUp('slow');
      	}
      });
		});
	</script>
@endpush
