@extends('layouts.site')

@section('content')
<div class="py-5 page register">
  <div class="container">
    <form method="POST" action="{{ route('register') }}" class="card m-auto w-50 form-step">
      @csrf
      
    	<div class="card-body">
    		<legend class="mb-4 text-center">Crie sua conta gratuita</legend>

        @include('shared.errors')

        <fieldset>
          <a href="{{ route('auth.redirect', 'facebook') }}" class="btn btn-primary btn-block mb-4"><i class="fab fa-facebook-f fa-fw"></i> Continuar com Facebook</a>
          <p class="line-title my-5">
            <span>Ou</span>
          </p>
          <div class="form-group">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="E-mail" required autocomplete="email" autofocus>
          </div>

          <div class="pt-4">
            <button type="button" class="btn btn-outline-dark btn-block btn-next"><i class="fas fa-envelope fa-fw"></i> Continuar com e-mail</button>
          </div>
        </fieldset>
      	
        <fieldset style="display: none;">
          <p id="emailWrapper" class="mb-4 text-center"><span></span> <a href="#" class="btn-link btn-previous ml-2"><i class="fas fa-edit fa-fw"></i></a></p>

          <div class="form-group">
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nome" required>
          </div>
          <div class="form-group">
            <select name="type" class="form-control" required>
              @foreach(range(0, 1) as $option)
                <option value="{{ $option }}">{{ \App\Enums\UserType::getDescription($option) }}</option>
              @endforeach
            </select>
          </div>
          <div id="cpf" class="form-group">
            <input type="text" name="cpf" value="{{ old('cpf') }}" class="form-control cpf" placeholder="CPF" required>
          </div>
          <div id="cnpj" class="form-group" style="display: none">
            <input type="text" name="cnpj" value="{{ old('cnpj') }}" class="form-control cnpj" placeholder="CNPJ">
          </div>
          <div id="companyName" class="form-group" style="display: none">
            <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control" placeholder="Nome da Empresa">
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Senha" required>
          </div>
          <div class="form-group">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Senha" required>
          </div>
          <div class="radio-group mb-4">
            <label><input type="radio" name="role" value="cliente" {{ old('role') == 'cliente' ? 'checked' : '' }} required> Contratar Servi??os</label>
            <label><input type="radio" name="role" value="profissional" {{ old('role') == 'profissional' ? 'checked' : '' }}> Prestar Servi??os</label>
          </div>

          <div class="pt-4">
            <button type="button" class="btn btn-outline-dark btn-block btn-next"><i class="fas fa-angle-double-right fa-fw"></i> Avan??ar</button>
          </div>
        </fieldset>

        <fieldset style="display: none;">
          <p class="mb-4"><span></span> <a href="#" class="btn-link btn-previous"><i class="fas fa-angle-double-left fa-fw"></i> Voltar</a></p>

          <input type="hidden" name="lat" value="{{ old('lat') ? old('lat') : NULL }}">
          <input type="hidden" name="lng" value="{{ old('lng') ? old('lng') : NULL }}">

          <div class="form-group inner-addon right-addon">
            <input type="text" name="postal_code" value="{{ old('postal_code') ? old('postal_code') : NULL }}" class="form-control postal_code" placeholder="CEP" onkeyup="getLocation(this, event)" required>
          </div>

          <div class="form-group">
            <input type="text" name="public_place" value="{{ old('public_place') ? old('public_place') : NULL }}" class="form-control" placeholder="Endere??o" required>
          </div>

          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <input type="text" name="street_number" value="{{ old('street_number') ? old('street_number') : NULL }}" class="form-control" placeholder="N??mero" required>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group">
                <input type="text" name="neighborhood" value="{{ old('neighborhood') ? old('neighborhood') : NULL }}" class="form-control" placeholder="Bairro" required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <input type="text" name="complement" value="{{ old('complement') ? old('complement') : NULL }}" class="form-control" placeholder="Complemento">
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <select name="state_id" class="form-control">
                  @foreach($states as $option)
                    <option value="{{ $option->id }}" data-uf="{{ $option->abbreviation }}">{{ $option->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <select name="city_id" class="form-control" data-current="{{ @$salon->city->id }}"></select>
              </div>
            </div>
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="termsOfUsePrivacyPolicy" required>
            <label class="custom-control-label" for="termsOfUsePrivacyPolicy">Eu aceito os <a href="#" class="show-item" data-toggle="modal" data-target="#modal-show" data-url="{{ route('pages.show', 'termos-de-uso') }}" data-large="true" data-title="Termos de Uso">Termos de Uso</a> e <a href="#" data-toggle="modal" class="show-item" data-target="#modal-show" data-url="{{ route('pages.show', 'politica-de-privacidade') }}" data-large="true" data-title="Pol??tica de Privacidade">Pol??tica de Privacidade</a></label>
          </div>

          <div class="pt-4">
            <button type="submit" class="btn btn-outline-dark btn-block"><i class="fas fa-check fa-fw"></i> Criar minha conta</button>
          </div>
        </fieldset>
    	</div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      $(document).on('change', '[name="email"]', function(e) {
        var email = $(this).val();
        $('#emailWrapper').find('span').text(email);
      });

      $(document).on('change', 'input[name="postal_code"]', function(e) {
        var postalCode = $(this).val(),
            publicPlace = $('[name="public_place"]').val(),
            neighborhood = $('[name="neighborhood"]').val();

        $.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + postalCode + ',' + publicPlace + ',' + neighborhood + '/&key=AIzaSyAJTkxCG1qynJCX6Wi-pbGF-Gu-exygpwU', function(data) {
          $('[name="lat"]').val(data.results[0].geometry.location.lat);
          $('[name="lng"]').val(data.results[0].geometry.location.lng);
        });
      });

      $(document).on('change', 'select[name="state_id"]', function(e) {
        var id = $(this).val(),
            select = $('select[name="city_id"]'),
            current = select.data('current');

        $.ajax({
          url: APP_URL + '/states/cities/' + id,
          type: 'GET',
          success: function(result) {
            select.empty();
            $.each(result, function(index, el) {
              if (el.id == current) {
                select.append('<option value="' + el.id + '" selected>' + el.name + '</option>');
              } else {
                select.append('<option value="' + el.id + '">' + el.name + '</option>');
              }
            });
          },
          error: function(xhr) {
            
          }
        });
      });

      $('select[name="state_id"]').trigger('change');
    }, false);
  </script>
@endpush
