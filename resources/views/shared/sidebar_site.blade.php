<div class="list-group list-group-root">
	@foreach($specialties as $key => $specialty)
		<a href="#item-{{ $specialty->id }}" class="list-group-item list-group-item-action font-weight-bold {{ request()->segment(count(request()->segments())) == $specialty->slug ? 'active' : NULL }}" {{ request()->segment(count(request()->segments())) == 'aria-current="true"' }} data-toggle="collapse">
			<i class="fas fa-chevron-{{ request()->segment(count(request()->segments())) == $specialty->slug ? 'down' : 'right' }}"></i> {{ $specialty->name }}
		</a>

		<div class="list-group collapse {{ request()->segment(count(request()->segments())) == $specialty->slug ? 'show' : NULL }}" id="item-{{ $specialty->id }}">
			@foreach($specialty->subspecialties as $key => $subspecialty)
				<a href="{{ route('subspecialties.show', [$subspecialty->specialty->slug, $subspecialty->slug]) }}" class="list-group-item list-group-item-action {{ request()->segment(count(request()->segments())) == $subspecialty->slug ? 'active' : NULL }}" {{ request()->segment(count(request()->segments())) == 'aria-current="true"' }}>{{ $subspecialty->name }}</a>
			@endforeach
		</div>
	@endforeach
</div>