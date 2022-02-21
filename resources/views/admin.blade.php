<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Mavii') }} - {{ $title }}</title>

  <link rel="shortcut icon" href="{{ asset('public/img/favicon.ico') }}" type="image/x-icon">

  <!-- Styles -->
  <link href="{{ asset('public/css/dashboard/styles.css') }}" rel="stylesheet">
</head>
<body>
  <div class="auth-wrapper">
    <div class="container pt-5">
      <div class="row">
        <div class="offset-sm-4 col-sm-4">
          <form method="POST" action="{{ route('login') }}" class="auth-box p-4 bg-white">
            @csrf

            <img src="{{ asset('public/img/brand.png') }}" class="d-block mb-5 mx-auto img-fluid">

            @include('shared.flash_messages')
            
            <div class="form-group">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="{{ __('E-Mail') }}" autocomplete="email" autofocus>
            </div>
            <div class="form-group">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="{{ __('Senha') }}" autocomplete="current-password">
            </div>

            <div class="form-group row">
              <div class="col-md-6">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" id="remember" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}>
                  <label class="custom-control-label" for="remember">{{ __('Lembrar') }}</label>
                </div>
              </div>
            </div>

            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror

            <div class="pt-4">
              <button type="submit" class="btn btn-dark btn-block">
                {{ __('Entrar') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>