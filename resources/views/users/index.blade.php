@extends('layouts.site')

@section('content')
<div class="py-5 page users">
	<div class="container">
	  <h3 class="section-title mb-5">
			<span>{{ $title }}</span>
			<hr>
		</h3>

		<div class="row">
			<div class="col-sm-3">
				<form onchange="filterUsers(this, event)">
					@csrf
					
					<input type="hidden" name="keyword" value="{{ request()->get('keyword') }}">
					@guest
						<input type="hidden" name="lat" value="{{ request()->get('lat') }}">
						<input type="hidden" name="lng" value="{{ request()->get('lng') }}">
					@else
						<input type="hidden" name="lat" value="{{ !request()->get('lat') && auth()->user()->address ? auth()->user()->address->lat : request()->get('lat') }}">
						<input type="hidden" name="lng" value="{{ !request()->get('lng') && auth()->user()->address ? auth()->user()->address->lng : request()->get('lng') }}">
					@endguest

					<div class="mb-4">
						<label for="distance" class="d-block mb-1 font-weight-bold">Distância <span id="output" class="float-right">50 Km</span></label>
						<input type="range" value="50" name="distance" min="1" max="100" class="custom-range" id="distance">
					</div>

					<div class="form-group">
						<option for="subspecialties[]" class="mb-1 font-weight-bold">Especialidades</option>
	          <select name="subspecialties[]" class="selectize" multiple>
	            @foreach($subspecialties as $key => $subspecialty)
	              <option value="{{ $subspecialty->id }}" {{ in_array($subspecialty->id, [request()->get('subspecialties')]) ? 'selected' : NULL }}>{{ $subspecialty->name }}</option>
	            @endforeach
	          </select>
	        </div>
				</form>
			</div>
			<div class="col-sm-9">
				<div id="users">
					@include('users._list')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			$(document).on('input', '[name="distance"]', function() {
				$('#output').text($(this).val() + ' Km');
			});

			@if(auth()->guest() || !auth()->user()->address)
				getPosition();
			@endif
		}, false);
	</script>
@endpush
