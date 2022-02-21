@extends('layouts.site')

@section('content')
<div class="py-5 page change-password">
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        @include('shared.sidebar_user')
      </div>
      <div class="col-sm-9">
        @include('shared.flash_messages')
        
        <form method="POST" action="{{ route('users.update_password') }}" class="card">
          <div class="card-body">
            @csrf
            
            <legend class="mb-4 text-center">{{ $title }}</legend>

            @include('shared.errors')

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="form-control-label" for="password">Senha</label>
                  <input type="password" name="password" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="form-control-label" for="password_confirmation">Confirmar Senha</label>
                  <input type="password" name="password_confirmation" class="form-control" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" required>
                </div>
              </div>
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
