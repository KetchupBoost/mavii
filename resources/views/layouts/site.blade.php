<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Mavii') }} - {{ @$title }}</title>

  <link rel="shortcut icon" href="{{ asset('public/img/favicon.ico') }}" type="image/x-icon">

  <!-- Scripts -->
  <script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!},
        currentUserId = {!! !Auth::check() ? 0 : Auth::id() !!};
  </script>
  <script src="{{ asset('js/scripts.js') }}" defer></script>
  <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GOOGLE_API_KEY', 'default_value') }}"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>

  <!-- Styles -->
  <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/site.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <div id="header" class="header {{ (Route::current()->getName() == 'root' || Route::current()->getName() == 'home') && !auth()->check() ? 'header-home' : NULL }}">
      @include('shared.navbar')

      @if((Route::current()->getName() == 'root' || Route::current()->getName() == 'home') && !auth()->check())
        <div class="container py-5">
          <div class="header__intro">
            <h1 class="mb-3">Torne seu evento inesquecível</h1>
            <p class="mb-4">Encontre aqui os melhores profissionas que lhe ajudarão <br>em cada detalhe no preparo do seu evento para que ele seja perfeito.</p>
            <a href="{{ route('register') }}" class="btn btn-outline-{{ Route::current()->getName() == 'root' || Route::current()->getName() == 'home' ? 'light' : 'dark' }} px-4">Começar agora</a>
          </div>
        </div>
      @endif
    </div>
    <div class="content">
      <main>
        @if((auth()->user() && request()->segment(count(request()->segments())) != 'perfil') && (auth()->user()->hasRole('profissional') && auth()->user()->user_subspecialties->isEmpty()))
          <div class="container pt-5">
            <div class="alert alert-warning" role="alert">
              <div class="row">
                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                  <i class="fas fa-info-circle fa-3x fa-fw text-secondary"></i>
                </div>
                <div class="col-sm-11">
                  <h4 class="alert-heading">Informe suas especialidades</h4>
                  <p>Olá Profissional, preencha as especialidades que você atende para aumentar suas chances de ser contratado.</p>
                  <hr>
                  <a href="{{ route('users.edit_profile') }}" class="btn btn-warning btn-sm px-4">Atualizar</a>
                </div>
              </div>
            </div>
          </div>
        @endif

        @if((auth()->user() && request()->segment(count(request()->segments())) != 'perfil' && request()->segment(count(request()->segments())) != 'finalizar-cadastro') && !auth()->user()->address))
          <div class="container pt-5">
            <div class="alert alert-warning" role="alert">
              <div class="row">
                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                  <i class="fas fa-info-circle fa-3x fa-fw text-secondary"></i>
                </div>
                <div class="col-sm-11">
                  <h4 class="alert-heading">Complete seu Cadastro</h4>
                  <p>Olá {{ auth()->user()->name }}, informe o que você deseja na nossa plataforma e preencha os seus dados de endereço.</p>
                  <hr>
                  <a href="{{ route('users.second_step_register') }}" class="btn btn-warning btn-sm px-4">Atualizar</a>
                </div>
              </div>
            </div>
          </div>
        @endif

        @yield('content')

        <div class="py-2 border-top">
          <div class="container">
            <div class="row">
              <div class="col-sm-2">
                <p class="mb-0">Meios de Pagamento:</p>
              </div>
              <div class="col-sm-10">
                <img src="{{ asset('public/img/credit-cards/visa.png') }}" class="img-fluid mx-2" style="width: 32px; object-fit: contain;"> 
                <img src="{{ asset('public/img/credit-cards/mastercard.png') }}" class="img-fluid mx-2" style="width: 32px; object-fit: contain;"> 
                <img src="{{ asset('public/img/credit-cards/elo.png') }}" class="img-fluid mx-2" style="width: 32px; object-fit: contain;">
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-4">
            <h6 class="footer__title">Mavii</h6>

            <ul class="list-unstyled mb-0">
              @foreach($pages as $key => $page)
                <li><a href="{{ route('pages.show', $page->slug) }}">{{ $page->title }}</a></li>
              @endforeach
              <li><a href="{{ route('contact') }}">Contato</a></li>
            </ul>
          </div>

          <div class="col-4">
            <h6 class="footer__title">Categorias</h6>

            <ul class="list-unstyled mb-0">
              @foreach($specialties as $key => $specialty)
                <li><a href="{{ route('specialties.show', $specialty->slug) }}">{{ $specialty->name }}</a></li>
              @endforeach
            </ul>
          </div>

          <div class="col-4">
            <h6 class="footer__title">Social</h6>

            <ul class="footer__social">
              <li><a href="{{ $info->facebook }}" target="_blank"><i class="fab fa-facebook-f fa-fw"></i></a></li>
              <li><a href="{{ $info->twitter }}" target="_blank"><i class="fab fa-twitter fa-fw"></i></a></li>
              <li><a href="{{ $info->instagram }}" target="_blank"><i class="fab fa-instagram fa-fw"></i></a></li>
              <li><a href="{{ $info->youtube }}" target="_blank"><i class="fab fa-youtube fa-fw"></i></a></li>
            </ul>
          </div>
        </div>

        <hr class="my-5" style="border-top: 1px solid rgba(255, 255, 255, .1);">

        <div class="row">
          <div class="col-6">
            <small class="font-italic" style="line-height: 35px;">Copyright &copy; {{ date('Y') }}</small>
          </div>
          <div class="col-6 text-right">
            <a href="http://saikoosistemas.com.br" class="footer__saikoo" target="_blank"></a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  @include('shared.modal_site')

  @push('scripts')
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function() {
        $(document).on('change', 'select[name="event_category_id"]', function(e) {
          var type = $(this).find(':selected').data('type');

          if (type == 1) {
            $('#serviceTypeInputs').slideUp('slow');
            $('#serviceTypeInputs').find('input, select').attr('disabled', true);
            $('#eventTypeInputs').slideDown('slow');
            $('#eventTypeInputs').find('input, select').removeAttr('disabled');
          } else {
            $('#eventTypeInputs').slideUp('slow');
            $('#eventTypeInputs').find('input, select').attr('disabled', true);
            $('#serviceTypeInputs').slideDown('slow');
            $('#serviceTypeInputs').find('input, select').removeAttr('disabled');
          }
        });
      });
    </script>
  @endpush

  @stack('scripts')
</body>
</html>
