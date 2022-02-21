@extends('layouts.site')

@section('content')
	<div class="page contact py-5">
		<div class="container">
      <h3 class="section-title mb-5">
        <span>{{ $title }}</span>
        <hr>
      </h3>
    
      @include('shared.flash_messages')
      
			<form action="{{ route('contact') }}" method="post">
				@csrf

				<div class="form-group">
          <label for="name" class="required">Nome</label>
          <input type="text" name="name" class="form-control" required>
        </div>

				<div class="row">
					<div class="col-sm-6">
            <div class="form-group">
              <label for="email" class="required">E-mail</label>
              <input type="email" name="email" class="form-control" required>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="phone">Telefone</label>
              <input type="text" name="phone" class="form-control phone">
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="cellphone" class="required">Celular</label>
              <input type="text" name="cellphone" class="form-control cellphone" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="body" class="required">Mensagem</label>
          <textarea name="body" class="form-control" rows="6" required></textarea>
        </div>

        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY', 'default_value') }}" data-callback="enableSubmit" data-expired-callback="disableSubmit" style="transform: scale(0.9); transform-origin: 0 0"></div>

        <div class="pt-5 text-right">
          <button type="submit" class="btn btn-dark px-5" disabled>Enviar</button>
        </div>
			</form>
		</div>
	</div>
@endsection