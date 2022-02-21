@extends('layouts.site')

@section('content')
<div class="py-5 page login">
  <div class="container">
    <form method="POST" action="{{ route('login') }}" class="card m-auto w-50">
      @csrf

      <input type="hidden" name="referer" value="{{ request()->headers->get('referer') }}">

      <div class="card-body">
        <legend class="mb-4 text-center">Login</legend>

        <div class="form-group">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email" autofocus>

          @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="form-group">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Senha" required autocomplete="current-password">

          @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="custom-control-label" for="remember">
                  {{ __('Lembrar') }}
                </label>
              </div>
            </div>
          </div>

          <div class="col-sm-6 text-right">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">
                {{ __('Esqueceu sua senha?') }}
              </a>
            @endif
          </div>
        </div>

        <div class="pt-4">
          <button type="submit" class="btn btn-outline-dark btn-block">
            {{ __('Entrar') }}
          </button>
          <p class="line-title my-5">
            <span>Ou</span>
          </p>
          <a href="{{ route('auth.redirect', 'facebook') }}" class="btn btn-primary btn-block mb-4"><i class="fab fa-facebook-f fa-fw"></i> Continuar com Facebook</a>
          <a href="{{ route('register') }}" class="btn btn-dark btn-block">Criar uma conta</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
