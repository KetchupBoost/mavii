@extends('layouts.site')

@section('content')
<div class="py-5 page personal-data">
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        @include('shared.sidebar_user')
      </div>
      <div class="col-sm-9">
        @include('shared.flash_messages')
        
        <form method="POST" action="{{ route('users.update') }}" class="card">
          <div class="card-body">
            @csrf

            <legend class="mb-4 text-center">{{ $title }}</legend>

            @include('shared.errors')

            <div class="form-group">
              <input type="text" name="name" value="{{ old('name') ? old('name') : $user->name }}" class="form-control" placeholder="Nome Completo" required>
            </div>

            <div class="form-group">
              <input type="email" name="email" value="{{ old('email') ? old('email') : $user->email }}" class="form-control" placeholder="E-mail" required autocomplete="email" autofocus>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" name="phone" value="{{ old('phone') ? old('phone') : @$user->phone }}" class="form-control phone" placeholder="Telefone">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" name="cellphone" value="{{ old('cellphone') ? old('cellphone') : @$user->cellphone }}" class="form-control cellphone" placeholder="Celular">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <select name="gender" class="form-control">
                    <option value="">Selecione</option>
                    @foreach(range(0, 2) as $option)
                      <option value="{{ $option }}" {{ @$user->gender == $option ? 'selected' : NULL }}>{{ \App\Enums\UserGender::getDescription($option) }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" name="birthdate" value="{{ old('birthdate') ? old('birthdate') : (!@$user->birthdate ? NULL : \Carbon\Carbon::parse(@$user->birthdate)->format('d/m/Y')) }}" class="form-control date" placeholder="Data de Nascimento" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <select name="type" class="form-control">
                    @foreach(range(0, 1) as $option)
                      <option value="{{ $option }}" {{ @$user->type == $option ? 'selected' : NULL }}>{{ \App\Enums\UserType::getDescription($option) }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div id="cpf" class="form-group" style="display: none;">
                  <input type="text" name="cpf" value="{{ old('cpf') ? old('cpf') : @$user->cpf }}" class="form-control cpf" placeholder="CPF">
                </div>
                <div id="cnpj" class="form-group" style="display: none;">
                  <input type="text" name="cnpj" value="{{ old('cnpj') ? old('cnpj') : @$user->cnpj }}" class="form-control cnpj" placeholder="CNPJ">
                </div>
              </div>
            </div>

            <div id="companyName" class="form-group" style="display: none;">
              <input type="text" name="company_name" value="{{ old('company_name') ? old('company_name') : $user->company_name }}" class="form-control" placeholder="Nome da Empresa">
            </div>

            <h5 class="line-title my-5">
              <span>Endereço</span>
            </h5>

            <input type="hidden" name="lat" value="{{ old('lat') ? old('lat') : @$user->address->lat }}">
            <input type="hidden" name="lng" value="{{ old('lng') ? old('lng') : @$user->address->lng }}">

            <div class="row">
              <div class="col-sm-3">
                <div class="form-group inner-addon right-addon">
                  <input type="text" name="postal_code" value="{{ old('postal_code') ? old('postal_code') : @$user->address->postal_code }}" class="form-control postal_code" placeholder="CEP" onkeyup="getLocation(this, event)" required>
                </div>
              </div>
              <div class="col-sm-9">
                <div class="form-group">
                  <input type="text" name="public_place" value="{{ old('public_place') ? old('public_place') : @$user->address->public_place }}" class="form-control" placeholder="Logradouro" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <input type="text" name="street_number" value="{{ old('street_number') ? old('street_number') : @$user->address->street_number }}" class="form-control" placeholder="Número" required>
                </div>
              </div>
              <div class="col-sm-9">
                <div class="form-group">
                  <input type="text" name="neighborhood" value="{{ old('neighborhood') ? old('neighborhood') : @$user->address->neighborhood }}" class="form-control" placeholder="Bairro" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <select name="state_id" class="form-control">
                    @foreach($states as $key => $state)
                      <option value="{{ $state->id }}" data-uf="{{ $state->abbreviation }}" {{ @$user->address->city->state->id != $state->id ? NULL : 'selected' }}>{{ $state->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <select name="city_id" class="form-control" data-current="{{ @$user->address->city_id }}" required></select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <input type="text" name="complement" value="{{ old('complement') ? old('complement') : @$user->address->complement }}" class="form-control" placeholder="Complemento">
            </div>

            <div class="pt-4 text-right">
              <input class="btn btn-dark px-5" type="submit" value="Salvar">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
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
    });
  </script>
@endpush
