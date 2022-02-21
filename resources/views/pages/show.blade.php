@extends('layouts.site')

@section('content')
<div class="py-5 page">
	<div class="container">
	  <div class="card">
	  	<div class="card-header" style="position: relative; background-color: transparent;">
	  		<h3 class="mb-0">{{ $title }}</h3>
	  	</div>

	  	<div class="card-body">
	  		{!! $page->body !!}
	  	</div>
	  </div>
	</div>
</div>
@endsection

